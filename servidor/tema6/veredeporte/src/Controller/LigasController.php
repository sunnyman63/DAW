<?php

namespace App\Controller;

use App\Entity\Equipo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Liga;
use App\Entity\Usuario;
use App\Form\LigaType;
use Symfony\Component\HttpFoundation\Request;

class LigasController extends AbstractController
{
    /**
     * @Route("/ligas", name="app_ligas")
     */
    public function index(EntityManagerInterface $em): Response {

        $ligas = [];
        $error = "";
        try {
            $ligas = $em->getRepository(Liga::class)->findAll();
            
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        $user = $this->getUser();
        return $this->render('ligas/ligas.html.twig', [
            'controller_name' => 'LigasController',
            'user'=>$user,
            'ligas' => $ligas,
            'error' => $error
        ]);
    }

    /**
     * @Route("/ligas/crear", name="app_crear_liga")
     */
    public function crearLiga(EntityManagerInterface $em, Request $request): Response {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $liga = new Liga();
        $now = new \DateTime();
        $nowFormated = $now->format("Y-m-d");
        $fechaPropuesta = new \Datetime($nowFormated." 17:00:00");
        $fechaPropuesta->add(new \DateInterval("P4D"));
        $liga->setFechaInicio($fechaPropuesta);
        
        $user = $this->getUser();
        $err = "";
        $form = $this->createForm(LigaType::class,$liga);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()) {
            try {
                
                if($form->get("fecha_inicio")->getData()->format("D") != "Mon") {
                    $err = "La fecha de inicio debe caer en Lunes";
                } else {
                    if(strtotime($form->get("fecha_inicio")->getData()->format("Y-m-d")) < strtotime($now->format("Y-m-d"))) {
                        $err = "Debe dar por lo menos 3 días desde hoy para que los equipos se apunten.";
                    } else {
                        $lig = $em->getRepository(Liga::class)->findOneby(array('tipo'=>$form->get("tipo")->getData()));
                        if(!empty($lig)) {
                            $fechaFinExistente = $lig->getFechaFin();
                            if($fechaFinExistente != null) {
                                if(strtotime($fechaFinExistente->format("Y-m-d")) <= strtotime($form->get("fecha_inicio")->getData()->format("Y-m-d"))) {
                                    $err = "No puede iniciar una liga de ".$form->get("tipo")->getData()." mientras otra este activa.";
                                }
                            } else {
                                $err = "No puede iniciar una liga de ".$form->get("tipo")->getData()." mientras otra este activa.";
                            }
                        } else {
                            $numMax = $form->get("max_equipos")->getData();
                            if($numMax < 4 || $numMax > 10) {
                                    $err = "El número máximo de equipos no es valido";
                            } else {
                                if($numMax % 2 != 0) {
                                    $err = "El número maximo de equipos solo puede ser 4, 6, 8 o 10.";
                                }
                            }
                        }
                    }
                }

                if($err != "") {
                    return $this->render('ligas/crearLigas.html.twig', [
                        'user' => $user,
                        'form' => $form->createView(),
                        'error' => $err,
                    ]);
                } else {
                    $em->persist($liga);
                    $em->flush();
                }
                
            } catch(\Exception $e) {
                $err = "Error del servidor.";
            }
            return $this->redirectToRoute('app_ligas');    
        }
        return $this->render('ligas/crearLigas.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'error' => $err,
        ]);
    }

    /**
     * @Route("/ligas/solicitar/{id}", name="app_solicitar_liga")
     */
    public function solicitarUnirse(EntityManagerInterface $em, $id): Response {
        
        $err = "";

        try {

            $usu = $em->getRepository(Usuario::class)->findOneBy(array('email'=>$this->getUser()->getUserIdentifier()));
            $equipo = $em->getRepository(Equipo::class)->find($usu->getEquipo()->getId());
            $liga = $em->getRepository(Liga::class)->find($id);

            $liga->addSolicitude($equipo);

            $em->persist($equipo);
            $em->persist($liga);

            $em->flush();

        } catch(\Exception $e) {
            $err = "Error del servidor";
        }

        return $this->redirectToRoute('app_ligas', ['error'=>$err]); 
    }

    /**
     * @Route("/ligas/cancelar/{id}", name="app_cancelar_solicitud_liga")
     */
    public function cancelarSolicitud(EntityManagerInterface $em, $id): Response {
        
        try {

            $usu = $em->getRepository(Usuario::class)->findOneBy(array('email'=>$this->getUser()->getUserIdentifier()));
            $equipo = $em->getRepository(Equipo::class)->find($usu->getEquipo()->getId());
            $liga = $em->getRepository(Liga::class)->find($id);

            $liga->removeSolicitude($equipo);

            $em->persist($equipo);
            $em->persist($liga);

            $em->flush();

        } catch(\Exception $e) {
            $err = "Error del servidor";
        }

        return $this->redirectToRoute('app_ligas'); 
    }

    /**
     * @Route("/ligas/salirse/{id}", name="app_salirse_liga")
     */
    public function salirDeLaLiga(EntityManagerInterface $em, $id): Response {
        
        try {

            $usu = $em->getRepository(Usuario::class)->findOneBy(array('email'=>$this->getUser()->getUserIdentifier()));
            $equipo = $em->getRepository(Equipo::class)->find($usu->getEquipo()->getId());
            $liga = $em->getRepository(Liga::class)->find($id);

            $liga->removeEquipo($equipo);

            $em->persist($equipo);
            $em->persist($liga);

            $em->flush();

        } catch(\Exception $e) {
            $err = "Error del servidor";
        }

        return $this->redirectToRoute('app_ligas'); 
    }

    /**
     * @Route("/ligas/expusar/{id}", name="app_expulsar_liga")
     */
    public function expulsarDeLaLiga(EntityManagerInterface $em, $id): Response {
        
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        try {

            $equipo = $em->getRepository(Equipo::class)->find($id);
            $liga = $equipo->getLiga();

            $liga->removeEquipo($equipo);

            $em->persist($equipo);
            $em->persist($liga);

            $em->flush();

        } catch(\Exception $e) {
            $err = "Error del servidor";
        }

        return $this->redirectToRoute('app_ligas'); 
    }

    /**
     * @Route("/ligas/cerrar/{id}", name="app_cerrar_liga")
     */
    public function cerrarLiga(EntityManagerInterface $em, $id): Response {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        try {

            $liga = $em->getRepository(Liga::class)->find($id);
            $equipos = $liga->getEquipos();
            foreach($equipos as $equipo) {
                $liga->removeEquipo($equipo);
                $em->persist($equipo);
            }
            $solicitudes = $liga->getSolicitudes();
            foreach($solicitudes as $solicitud) {
                $liga->removeSolicitude($solicitud);
                $em->persist($equipo);
            }
            
            $em->remove($liga);

            $em->flush();

        } catch(\Exception $e) {
            $err = "Error del servidor";
        }

        return $this->redirectToRoute('app_ligas'); 

    }
}
