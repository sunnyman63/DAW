<?php

namespace App\Controller;

use App\Service\proveedor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ejer4")
 */
class Ejer4Controller extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {
        return $this->render('ejer4/index.html.twig', [
            'controller_name' => 'Ejer4Controller',
        ]);
    }

    /**
     * @Route("/apa", name="app_apa")
     */
    public function apa(): Response {
        return new Response("Qué apartado más soso");
    }

    /**
     * @Route("/apb/{a}/{b}", name="app_apb")
     */
    public function apb(proveedor $prov, $a = null,$b = null): Response {
        
        $array = [];

        if($a == null || $b == null) {
            return $this->render('ejer4/apb.html.twig', [
                'array' => $array
            ]);
        }

        $nums = $prov->generador($a,$b);
        $suma = 0;
        foreach($nums as $num) {
            $suma = $suma + $num;
        }

        $array = [
            'cantidad'=>$a,
            'suma' => $suma
        ];
        
        return $this->render('ejer4/apb.html.twig', [
            'array' => $array
        ]);
    }
}
