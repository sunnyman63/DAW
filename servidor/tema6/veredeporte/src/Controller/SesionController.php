<?php

namespace App\Controller;

use App\Form\RegistroType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SesionController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response {
        return $this->redirectToRoute('app_inicio');
    }

    /**
     * @Route("/home", name="app_inicio")
     */
    public function inicio(): Response {

        $this->denyAccessUnlessGranted('PUBLIC_ACCESS','ROLE_USER','ROLE_ADMIN');

        return $this->render('index.html.twig', [
            'controller_name' => 'SesionController',
            'user' => $this->getUser(),
            'error' => '',
        ]);
    }
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authUtils): Response
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('sesion/login.html.twig', [
            'controller_name' => 'SesionController',
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }
    /**
     * @Route("/registro", name="app_registro")
     */
    public function registro(UserPasswordHasherInterface $passwordHasher, Request $request, EntityManagerInterface $em): Response {

        $user = new Usuario();
        $err = "";
        $form = $this->createForm(RegistroType::class,$user);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()) {
            $pass1 = $form->get("password")->getData();
            $pass2 = $form->get("password2")->getData();
            if(strcmp($pass1,$pass2) == 0) {
                $a = ['ROLE_JUGADOR'];
                $user->setRoles($a);
                $hashedPassword = $passwordHasher->hashPassword($user,$form->get("password")->getData());
                $user->setPassword($hashedPassword);
                try {
                    $em->persist($user);
                    $em->flush();
                } catch(\Exception $e) {
                    if(str_contains($e,"SQLSTATE[23000]")) {
                        $err = "Ya existe una cuenta con ese correo.";
                    } else {
                        $err = "Error del servidor.";
                    }
                    return $this->render('sesion/register.html.twig', [
                        'controller_name' => 'SesionController',
                        'form' => $form->createView(),
                        'error' => $err,
                    ]);
                }
                return $this->redirectToRoute('app_login');
            } else {
                $err = "Las contraseñas no coinciden.";
                return $this->render('sesion/register.html.twig', [
                    'controller_name' => 'SesionController',
                    'form' => $form->createView(),
                    'error' => $err,
                ]);
            }
            
        }
        return $this->render('sesion/register.html.twig', [
            'controller_name' => 'SesionController',
            'form' => $form->createView(),
            'error' => $err
        ]);
    }
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \Exception('Dont forget to activate logout in security.yalm');
    }
}
