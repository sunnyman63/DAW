<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use App\Entity\Liga;
use App\Entity\Equipo;
use App\Form\RegistroType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdministracionController extends AbstractController
{
    /**
     * @Route("/administracion", name="app_administracion")
     */
    public function index(): Response{

        $user = $this->getUser();
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/administracion.html.twig', [
            'user' => $user,
            'error' => ''
        ]);
    }

    /**
     * @Route("/administracion/nuevo/profesor", name="app_nuevo_profesor")
     */
    public function nuevoProfe(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em, Request $request): Response {


        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = $this->getUser();
        $usuario = new Usuario();
        $err = "";
        $form = $this->createForm(RegistroType::class,$usuario);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()) {
            $pass1 = $form->get("password")->getData();
            $pass2 = $form->get("password2")->getData();
            if(strcmp($pass1,$pass2) == 0) {
                $a = ['ROLE_ADMIN'];
                $usuario->setRoles($a);
                $hashedPassword = $passwordHasher->hashPassword($usuario,$form->get("password")->getData());
                $usuario->setPassword($hashedPassword);
                try {
                    $em->persist($usuario);
                    $em->flush();
                } catch(\Exception $e) {
                    if(str_contains($e,"SQLSTATE[23000]")) {
                        $err = "Ya existe una cuenta con ese correo.";
                    } else {
                        $err = "Error del servidor.";
                    }
                    return $this->render('admin/nuevoProfesor.html.twig', [
                        'user' => $user,
                        'form' => $form->createView(),
                        'error' => $err,
                    ]);
                }
                return $this->redirectToRoute('app_login');
            } else {
                $err = "Las contraseñas no coinciden.";
                return $this->render('admin/nuevoProfesor.html.twig', [
                    'user' => $user,
                    'form' => $form->createView(),
                    'error' => $err,
                ]);
            }
            
        }

        return $this->render('admin/nuevoProfesor.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'error' => $err
        ]);
    }

    /**
     * @Route("/administracion/liga/solicitudes", name="app_gestionar_ligas")
     */
    public function gestionarSolicitudesLiga(EntityManagerInterface $em): Response {

        $user = $this->getUser();
        $err = "";
        $ligas = array();
        try {
            $ligas = $em->getRepository(Liga::class)->findAll();
        } catch(\Exception $e) {
            $err = "Error del servidor.";
        }
        return $this->render('admin/administrarSolicitudesLigas.html.twig', [
            'user' => $user,
            'ligas' => $ligas,
            'error' => $err
        ]);
    }

    /**
     * @Route("/administracion/liga/solicitud/aceptar/{id}", name="app_aceptar_solicitud_ligas")
     */
    public function aceptarSolicitudLigas(EntityManagerInterface $em, $id): Response {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user = $this->getUser();
        $error = "";
        try {
            $equipo = $em->getRepository(Equipo::class)->find($id);
            $liga = $equipo->getSolicitarParticipar();

            $liga->removeSolicitude($equipo);
            $liga->addEquipo($equipo);

            $em->persist($liga);
            $em->persist($equipo);
            $em->flush();
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        
        return $this->redirectToRoute('app_gestionar_ligas');
    }

    /**
     * @Route("/administracion/liga/solicitud/denegar/{id}", name="app_denegar_solicitud_ligas")
     */
    public function denegarSolicitudLigas(EntityManagerInterface $em, $id): Response {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user = $this->getUser();
        $error = "";
        try {
            $equipo = $em->getRepository(Equipo::class)->find($id);
            $liga = $equipo->getSolicitarParticipar();

            $liga->removeSolicitude($equipo);
            
            $em->persist($liga);
            $em->persist($equipo);
            $em->flush();
        } catch(\Exception $e) {
            $error = "Error del servidor";
        }
        
        return $this->redirectToRoute('app_gestionar_ligas');
    }

    /**
     * @("/administracion/generar/partidos" name="app_generar_partidos_liga")
     */
    public function cerrarLiga() {

    }
}
