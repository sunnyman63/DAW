<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use App\Entity\Equipo;
use Doctrine\ORM\EntityManagerInterface;

class EquipoController extends AbstractController
{
    /**
     * @Route("/equipo", name="app_equipo")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $soliEquipo = "";
        $this->denyAccessUnlessGranted('ROLE_USER');
        $usu = $em->getRepository(Usuario::class)->findBy(array('email'=>$this->getUser()->getUserIdentifier()));
        if($usu[0]->getEquipo()) {
            $equipo = $usu[0]->getEquipo();
            $soliEquipo = $equipo->getSolicitudes();
        }
        return $this->render('equipo/equipo.html.twig', [
            'controller_name' => 'EquipoController',
            'user' => $this->getUser(),
            'solicitudes' => $usu[0]->getSolicitudes(),
            'soliEquipo' => $soliEquipo,
        ]);
    }

    /**
     * @Route("/equipo/buscar", name="app_buscar_equipo")
     */
    public function listarEquipos(EntityManagerInterface $em): Response {
        $usu = $em->getRepository(Usuario::class)->findBy(array('email'=>$this->getUser()->getUserIdentifier()));
        $equipos = $em->getRepository(Equipo::class)->findAll();
        return $this->render('equipo/listaEquipos.html.twig', [
            'controller_name' => 'EquipoController',
            'user' => $this->getUser(),
            'equipos' => $equipos,
            'solicitudes'=>$usu[0]->getSolicitudes(),
        ]);
    }

    /**
     * @Route("/equipo/solicitar/{id}", name="app_solicitar_unirse")
     */
    public function solicitarUnirse(EntityManagerInterface $em, $id): Response {
        $usu = $em->getRepository(Usuario::class)->findBy(array('email'=>$this->getUser()->getUserIdentifier()));
        $equipo = $em->getRepository(Equipo::class)->find($id);
        $usu[0]->addSolicitude($equipo);
        $em->persist($usu[0]);
        $em->persist($equipo);
        $em->flush();
        return $this->redirectToRoute('app_equipo');
    }

    /**
     * @Route("/equipo/cancelar/{id}", name="app_cancelar_solicitud")
     */
    public function cancelarSolicitud(EntityManagerInterface $em, $id): Response {
        $usu = $em->getRepository(Usuario::class)->findBy(array('email'=>$this->getUser()->getUserIdentifier()));
        $equipo = $em->getRepository(Equipo::class)->find($id);
        $usu[0]->removeSolicitude($equipo);
        $em->persist($usu[0]);
        $em->persist($equipo);
        $em->flush();
        return $this->redirectToRoute('app_equipo');
    }

    /**
     * @Route("/equipo/prueba", name="app_prueba")
     */
    public function prueba(EntityManagerInterface $em): Response {
        $usu = $em->getRepository(Usuario::class)->findBy(array('email'=>$this->getUser()->getUserIdentifier()));
        return $this->render('pruebas.html.twig', [
            'controller_name' => 'EquipoController',
            'user' => $this->getUser(),
            'equipos' => '',
            'solicitudes' => $usu[0]->getSolicitudes(),
        ]);
    }
}
