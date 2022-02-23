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
        $now->add(new \DateInterval("P7D"));
        $liga->setFechaInicio($now);
        
        $user = $this->getUser();
        $err = "";
        $form = $this->createForm(LigaType::class,$liga);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()) {
            try {
                
                if(strtotime($liga->getFechaInicio()->format("Y-m-d")) < strtotime($now->format("Y-m-d"))) {
                    return $this->render('ligas/crearLigas.html.twig', [
                        'controller_name' => 'SesionController',
                        'user' => $user,
                        'form' => $form->createView(),
                        'error' => "Debe dar por lo menos una semana desde hoy para que lso equipos se apunten.",
                    ]);
                }

                $lig = $em->getRepository(Liga::class)->findOneby(array('tipo'=>$form->get("tipo")->getData()));
                if(!empty($lig)) {
                    $fechaFinExistente = $lig->getFechaFin();
                    if($fechaFinExistente != null) {
                        if(strtotime($fechaFinExistente) <= strtotime($liga->getFechaInicio)) {
                            return $this->render('ligas/crearLigas.html.twig', [
                                'controller_name' => 'SesionController',
                                'user' => $user,
                                'form' => $form->createView(),
                                'error' => "No puede iniciar una liga de ".$liga->getTipo()." mientras otra este activa.",
                            ]);
                        }
                    } else {
                        return $this->render('ligas/crearLigas.html.twig', [
                            'controller_name' => 'SesionController',
                            'user' => $user,
                            'form' => $form->createView(),
                            'error' => "No puede iniciar una liga de ".$liga->getTipo()." mientras otra este activa.",
                        ]);
                    }
                }
                $numMax = $liga->getMaxEquipos();
                if($numMax < 4 || $numMax > 10) {
                    return $this->render('ligas/crearLigas.html.twig', [
                        'controller_name' => 'SesionController',
                        'user' => $user,
                        'form' => $form->createView(),
                        'error' => "El número máximo de equipos no es valido",
                    ]);
                }
                $em->persist($liga);
                $em->flush();
            } catch(\Exception $e) {
                $err = "Error del servidor.";
            }
            return $this->redirectToRoute('app_ligas');    
        }
        return $this->render('ligas/crearLigas.html.twig', [
            'controller_name' => 'SesionController',
            'user' => $user,
            'form' => $form->createView(),
            'error' => $err
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
}
