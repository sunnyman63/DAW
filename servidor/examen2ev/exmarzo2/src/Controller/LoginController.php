<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\RegistroType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/", name="app_inicio")
     */
    public function inicio() {
        $this->denyAccessUnlessGranted("PUBLIC_ACCESS");
        return $this->render('login/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $au): Response
    {
        $error = $au->getLastAuthenticationError();
        $lastUsername = $au->getLastUsername();
        return $this->render('login/login.html.twig', [
            'error' => $error,
            'lastUsername' => $lastUsername,

        ]);
    }

    /**
     * @Route("/registro", name="app_register")
     */
    public function register(UserPasswordHasherInterface $uphi, Request $r, EntityManagerInterface $em): Response
    {
        $user = new Usuario();
        $form = $this->createForm(RegistroType::class,$user);
        $error = "";

        $form->handleRequest($r);
        if($form->isSubmitted() && $form->isValid()) {
            $pass = $form->get('password')->getData();
            $pass2 = $form->get('password2')->getData();
            if($pass === $pass2) {
                $a = ["ROLE_".$form->get("rol")->getData()];
                $user->setRoles($a);
                $hassPass = $uphi->hashPassword($user,$form->get("password")->getData());
                $user->setPassword($hassPass);
    
                try {
                    $em->persist($user);
                    $em->flush();
                }catch(\Exception $e) {
                    $error = "Ya existe un usuario registrado con ere correo.";
                    return $this->render('login/registro.html.twig', [
                        'form' => $form->createView(),
                        'error' => $error
                    ]);
                }
    
                return $this->redirectToRoute('app_login');
            } else {
                $error = "Las contraseñas deben coincidir";
            }
            
        }

        return $this->render('login/registro.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): Void
    {
        throw new \Exception(
            'No te olvides de activar el logout en security.yalm.
            Antonio si lees esto, apruebame :D'
        );
    }
}
