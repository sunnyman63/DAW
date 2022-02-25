<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use App\Entity\Equipo;
use App\Form\EquipoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class EquipoController extends AbstractController
{
    /**
     * @Route("/equipo/", name="app_equipo")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_JUGADOR');
        $user = $this->getUser();
        $soliEquipo = "";
        $solicitudes = "";
        $error = "";

        if(!empty($error)) {
            $error = "Error del servidor";
        }

        try {
            $usu = $em->getRepository(Usuario::class)->findBy(array('email'=>$user->getUserIdentifier()));
            if($usu[0]->getEquipo()) {
                $equipo = $usu[0]->getEquipo();
                $soliEquipo = $equipo->getSolicitudes();
            }
            $solicitudes = $usu[0]->getSolicitudes();
        } catch (\Exception $e) {
            $error = "Error del servidor";
        }
        
        return $this->render('equipo/equipo.html.twig', [
            'controller_name' => 'EquipoController',
            'user' => $user,
            'solicitudes' => $solicitudes,
            'soliEquipo' => $soliEquipo,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/equipo/crear", name="app_crear_equipo")
     */
    public function crearEquipo(Request $request, EntityManagerInterface $em): Response {

        $this->denyAccessUnlessGranted('ROLE_JUGADOR');
        $equipo = new Equipo();
        $user = $this->getUser();
        $err = "";
        $usu = $em->getRepository(Usuario::class)->findOneBy(array('email'=>$user->getUserIdentifier()));
        $form = $this->createForm(EquipoType::class,$equipo);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()) {
            try {
                $equipo->addJugadore($usu);
                $usu->setRoles(['ROLE_CAPITAN','ROLE_JUGADOR']);
                $em->persist($usu);
                $em->persist($equipo);
                $em->flush();
            } catch(\Exception $e) {
                $err = "Error del servidor.";
            }
            return $this->redirectToRoute('app_login');    
        }
        return $this->render('equipo/crearEquipo.html.twig', [
            'controller_name' => 'SesionController',
            'user' => $user,
            'form' => $form->createView(),
            'error' => $err
        ]);
    }

    /**
     * @Route("/equipo/buscar", name="app_buscar_equipo")
     */
    public function listarEquipos(EntityManagerInterface $em): Response {

        $this->denyAccessUnlessGranted('ROLE_JUGADOR');
        $user = $this->getUser();
        $equipos = "";
        $solicitudes = "";
        $error = "";
        try {
            $usu = $em->getRepository(Usuario::class)->findBy(array('email'=>$user->getUserIdentifier()));
            $equipos = $em->getRepository(Equipo::class)->findAll();
            $solicitudes = $usu[0]->getSolicitudes();
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        
        return $this->render('equipo/listaEquipos.html.twig', [
            'controller_name' => 'EquipoController',
            'user' => $user,
            'equipos' => $equipos,
            'solicitudes'=> $solicitudes,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/equipo/solicitar/{id}", name="app_solicitar_unirse")
     */
    public function solicitarUnirse(EntityManagerInterface $em, $id): Response {

        $this->denyAccessUnlessGranted('ROLE_JUGADOR');
        $error = "";
        try {
            $usu = $em->getRepository(Usuario::class)->findBy(array('email'=>$this->getUser()->getUserIdentifier()));
            $equipo = $em->getRepository(Equipo::class)->find($id);
            $usu[0]->addSolicitude($equipo);
            $em->persist($usu[0]);
            $em->persist($equipo);
            $em->flush();
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        
        return $this->redirectToRoute('app_equipo');
    }

    /**
     * @Route("/equipo/cancelar/{id}", name="app_cancelar_solicitud")
     */
    public function cancelarSolicitud(EntityManagerInterface $em, $id): Response {

        $this->denyAccessUnlessGranted('ROLE_JUGADOR');
        $error = "";
        try {
            $usu = $em->getRepository(Usuario::class)->findBy(array('email'=>$this->getUser()->getUserIdentifier()));
            $equipo = $em->getRepository(Equipo::class)->find($id);
            $usu[0]->removeSolicitude($equipo);
            $em->persist($usu[0]);
            $em->persist($equipo);
            $em->flush();
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        
        return $this->redirectToRoute('app_equipo');
    }

    /**
     * @Route("/equipo/denegar/{id}", name="app_denegar_solicitud")
     */
    public function denegarSolicitud(EntityManagerInterface $em, $id): Response {

        $this->denyAccessUnlessGranted('ROLE_CAPITAN');
        $error = "";
        try {
            $usu = $em->getRepository(Usuario::class)->findBy(array('email'=>$this->getUser()->getUserIdentifier()));
            $usuRechazado = $em->getRepository(Usuario::class)->find($id);
            $equipo = $em->getRepository(Equipo::class)->find($usu[0]->getEquipo()->getId());
            $usuRechazado->removeSolicitude($equipo);
            $em->persist($usuRechazado);
            $em->persist($equipo);
            $em->flush();
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        
        return $this->redirectToRoute('app_equipo');
    }

    /**
     * @Route("/equipo/aceptar/{id}", name="app_aceptar_solicitud")
     */
    public function aceptarSolicitud(EntityManagerInterface $em, $id): Response {

        $this->denyAccessUnlessGranted('ROLE_CAPITAN');
        $user = $this->getUser();
        $error = "";
        try {
            $usu = $em->getRepository(Usuario::class)->findBy(array('email'=> $user->getUserIdentifier()));
            $usuAceptado = $em->getRepository(Usuario::class)->find($id);
            $equipo = $em->getRepository(Equipo::class)->find($usu[0]->getEquipo()->getId());
            $usuAceptado->removeSolicitude($equipo);
            $equipo->addJugadore($usuAceptado);
            $em->persist($usuAceptado);
            $em->persist($equipo);
            $em->flush();
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        
        return $this->redirectToRoute('app_equipo');
    }

    /**
     * @Route("/equipo/expulsar/{id}", name="app_expulsar_jugador")
     */
    public function expulsarJugador(EntityManagerInterface $em, $id): Response {

        $this->denyAccessUnlessGranted('ROLE_CAPITAN');
        $user = $this->getUser();
        $error = "";
        try {
            $usu = $em->getRepository(Usuario::class)->findOneBy(array('email'=>$user->getUserIdentifier()));
            $usuExpulsado = $em->getRepository(Usuario::class)->find($id);
            $equipo = $em->getRepository(Equipo::class)->find($usu->getEquipo()->getId());
            $equipo->removeJugadore($usuExpulsado);
            $em->persist($usuExpulsado);
            $em->persist($equipo);
            $em->flush();
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        
        return $this->redirectToRoute('app_equipo');
    }

    /**
     * @Route("/equipo/salir/", name="app_dejar_equipo")
     */
    public function dejarEquipo(EntityManagerInterface $em): Response {

        $this->denyAccessUnlessGranted('ROLE_JUGADOR');
        $error = "";
        try {
            $usu = $em->getRepository(Usuario::class)->findOneBy(array('email'=>$this->getUser()->getUserIdentifier()));
            $equipo = $em->getRepository(Equipo::class)->find($usu->getEquipo()->getId());
            if($this->isGranted("ROLE_CAPITAN")) {
                $jugadores = $em->getRepository(Usuario::class)->findBy(array("equipo" => $equipo->getId()));
                foreach($jugadores as $jugador) {
                    $equipo->removeJugadore($jugador);
                    $em->persist($jugador);
                }
                $usu->setRoles(["ROLE_JUGADOR"]);
                $em->remove($equipo);
            } else {
                $equipo->removeJugadore($usu);
                $em->persist($usu);
                $em->persist($equipo);
            }
            
            $em->flush();
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        
        return $this->redirectToRoute('app_equipo');
    }

    /**
     * @Route("/equipo/prueba", name="app_prueba")
     */
    public function prueba(EntityManagerInterface $em): Response {
        $usu = $em->getRepository(Usuario::class)->findBy(array('email'=>$this->getUser()->getUserIdentifier()));
        $equipo = $em->getRepository(Equipo::class)->find($usu[0]->getEquipo()->getId());
        $jugadores = $em->getRepository(Usuario::class)->findBy(array("equipo" => $equipo->getId()));
        if(!empty($jugadores)) {
            $jugador = $jugadores;
        }
        return $this->render('pruebas.html.twig', [
            'controller_name' => 'EquipoController',
            'user' => $this->getUser(),
            'equipos' => '',
            'solicitudes' => $usu[0]->getSolicitudes(),
            'jugadores' => $jugadores,
            'jugador' => $jugador,
            'error' => ''
        ]);
    }
}
