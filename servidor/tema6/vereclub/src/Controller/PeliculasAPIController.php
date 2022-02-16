<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pelicula;
use App\Repository\PeliculaRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/peliculas/api")
 */
class PeliculasAPIController extends AbstractFOSRestController
{
    private $em;
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * @Rest\Get ("/", name="lista_peliculas")
     * @Rest\View(serializerGroups={"pelicula"}, serializerEnableMaxDepthChecks=true)
     */
    public function lista_peliculas(EntityManagerInterface $em) {
        return $em->getRepository(Pelicula::class)->findAll();
    }

    /**
     * @Rest\Get("/{id}", name="busca_pelicula")
     * @Rest\View(serializerGroups={"pelicula"}, serializerEnableMaxDepthChecks=true)
     */

    public function indicePeliculas($id) {
        $pelicula=$this->em->getRepository(Pelicula::class)->find($id);
        if($pelicula) {
            $respuesta = [
                'ok' => true,
                'pelicula' => $pelicula
            ];
        } else {
            $respuesta = [
                'ok' => false,
                'error' => 'Pelicula no encontrada'
            ];
        }
        return $respuesta;
    }

    /**
     * @Rest\Post("/", name="nueva_pelicula")
     * @Rest\View(serializerGroups={"pelicula"}, serializerEnableMaxDepthChecks=true)
     */
    public function nuevaPeliculas(Request $request) {

        $peli = new Pelicula();
        $peli->setTitulo($request->request->get('titulo'));
        $peli->setAnyo($request->request->get('anyo'));

        $this->em->persist($peli);
        $this->em->flush();
        $respuesta = [
            'ok' => true,
            'pelicula' => $peli
        ];
        return $respuesta;
    }
}
