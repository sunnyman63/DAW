<?php

namespace App\Controller;

use App\Entity\Asignatura;
use App\Entity\Usuario;
use App\Form\AsignaturaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaginasController extends AbstractController
{
    /**
     * @Route("/externo", name="app_externo")
     */
    public function externo(): Response
    {
        $this->denyAccessUnlessGranted("ROLE_EXTERNO");
        return $this->render('paginas/externo.html.twig');
        //Esta en la jerarquia que estudiante tiene los permisos de externo,
        //pero sigue sin dejar entrar
    }

    /**
     * @Route("/estudiante", name="app_estudiante")
     */
    public function estudiante(): Response
    {
        $this->denyAccessUnlessGranted("ROLE_ESTUDIANTE");
        return $this->render('paginas/estudiante.html.twig',[
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/generarAsignatura", name="app_generar_asignatura")
     */
    public function profe(Request $r, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted("ROLE_PROFESOR");
        $asig = new Asignatura();
        $form = $this->createForm(AsignaturaType::class,$asig);

        $form->handleRequest($r);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $em->persist($asig);
                $em->flush();
            }catch(\Exception $e) {
                return new Response("Esto ha petao mi ninio.");
            }

            return $this->redirectToRoute('app_inicio');
        }

        return $this->render('paginas/generarAsignaturas.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/lista/Usuarios", name="app_listar_usuarios")
     */
    public function listarUsers(EntityManagerInterface $em): Response
    {
        $lista = "";
        try {
            $lista = $em->getRepository(Usuario::class)->findAll();
        } catch(\Exception $e) {
            return new Response("Esto ha petao mi ninio.");
        }
        return $this->render('paginas/listaUsers.html.twig',[
            'users' => $lista,
        ]);
    }
}
