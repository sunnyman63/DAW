<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use App\Entity\Equipo;

class EquipoController extends AbstractController
{
    /**
     * @Route("/equipo", name="app_equipo")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('equipo/equipo.html.twig', [
            'controller_name' => 'EquipoController',
            'user' => $this->getUser(),
            //'equipo' => $ $this->getUser()->getEquipo()
        ]);
    }
}
