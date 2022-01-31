<?php

namespace App\Controller;

use App\Form\UsuarioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/", name="app_inicio")
     */
    public function inicio(): Response {

        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authUtils): Response
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('login/login.html.twig', [
            'controller_name' => 'LoginController',
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }
    /**
     * @Route("/registro", name="app_registro")
     */
    public function registro(UserPasswordHasherInterface $passwordHasher, Request $request, EntityManagerInterface $em): Response {

        $user = new Usuario();

        $form = $this->createForm(UsuarioType::class,$user);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()) {
            $a = ['ROLE_USER'];
            $user->setRoles($a);
            $hashedPassword = $passwordHasher->hashPassword($user,$form->get("password")->getData());
            $user->setPassword($hashedPassword);
            try {
                $em->persist($user);
                $em->flush();
            } catch(\Exception $e) {
                return new Response("Esto ha petado");
            }
            return $this->redirectToRoute('app_login');
        }
        return $this->render('login/registro.html.twig', [
            'controller_name' => 'LoginController',
            'form' => $form->createView(),
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
