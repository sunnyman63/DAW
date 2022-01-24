<?php 
//src/Controller/saludosControlador.php 
namespace App\Controller; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Annotation\Route;
use App\Service\nombresAleatorios;
use App\Service\numeroAleatorio;
use App\Entity\Pelicula;
use Doctrine\ORM\EntityManagerInterface;

class peliculasController extends AbstractController {

    private $em;
    private $peliculas;
    private $aleatorio;

    public function __construct(EntityManagerInterface $em, nombresAleatorios $nombres, numeroAleatorio $aleatorio){
        $this->em = $em;
        $this->peliculas = $nombres;
        $this->aleatorio = $aleatorio;
    }

    /**
    * @Route("/insertar", name="app_insertarPelicula")
    */
    public function insertarPelicula() {
        $entityManager = $this->em;
        $pelicula = new Pelicula();
        $pelicula->nombre = $this->peliculas->getPelicula();
        $entityManager->persist($pelicula);
        $entityManager->flush();
        return $this->render('insertado.html.twig',array("pelicula"=>$pelicula->nombre));
    }

    /**
    * @Route("/aleatoria", name="app_peliculaAleatoria")
    */
    public function mostrarPelicula() {
        $repositorio = $this->em->getRepository(Pelicula::class);
        $pelicula = $repositorio->find($this->aleatorio->get());
        return $this->render('insertado.html.twig',array("pelicula"=>$pelicula->nombre));
    }
}