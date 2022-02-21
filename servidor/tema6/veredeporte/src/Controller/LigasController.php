<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Liga;
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

        $liga = new Liga();
        $user = $this->getUser();
        $err = "";
        $form = $this->createForm(LigaType::class,$liga);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()) {
            try {
                $liga = $em->getRepository(Liga::class)->findOneby(array('tipo'=>$form->get("tipo")->getData()));
                if(!empty($liga)) {
                    return $this->render('ligas/crearLigas.html.twig', [
                        'controller_name' => 'SesionController',
                        'user' => $user,
                        'form' => $form->createView(),
                        'error' => "Ya existe una liga de".$form->get("tipo")->getData(),
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
}
