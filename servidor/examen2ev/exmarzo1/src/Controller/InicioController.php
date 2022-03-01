<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InicioController extends AbstractController
{
    /**
     * @Route("/", name="app_inicio")
     */
    public function index(): Response
    {
        return $this->render('inicio/inicio.html.twig');
    }

    /**
     * @Route("/verdad", name="app_buena")
     */
    public function verdad(): Response {
        return $this->render('inicio/verdad.html.twig');
    }
}
