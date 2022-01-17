<?php 
//src/Controller/saludosControlador.php 
namespace App\Controller; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use App\Service\BDPrueba;
use App\Entity\Alumno;

class saludosControlador extends AbstractController { 

    private $alumnos;

    private $logger;

    public function __construct(LoggerInterface $logger, BDPrueba $datos){
    $this->logger = $logger;
    $this->alumnos = $datos->get();
    }

    /**
    * @Route("/contacto/insertar", name="insertar_contacto")
    */
    public function insertar(){
        $entityManager = $this->getDoctrine()->getManager();
        $contacto = new Alumno();
        $contacto->setNombre("Andrea");
        $contacto->setApellido("Macias");
        $contacto->setEdad("18");
        $entityManager->persist($contacto);
        $entityManager->flush();
        return new Response("Contacto insertado con id " . $contacto->getId());
    }

    /**
    * @Route("/log", name="app_log")
    */
    public function log(){
        $fecha_hora = new \DateTime();
        $this->logger->info("Acceso el " .
        $fecha_hora->format("d/m/Y H:i:s"));
        return $this->render('bienvenido.html.twig');
    }

    /**
    * @Route("/", name="inicio")
    */
    public function inicio() {
        return $this->render('bienvenido.html.twig');
    }

    /**
     * @Route("/buscar/{num<\d+>}", name="app_buscarId")
     */
    public function buscar($num) {
        if($num>=-1 && $num<count($this->alumnos)){

            return $this->render('ficha_contacto.html.twig',array("contacto"=>$this->alumnos[$num],"contactos"=>null));

        } else {

            return $this->render('ficha_contacto.html.twig',array("contacto"=>null,"contactos"=>null));
            
        }
        
        // return new Response($respuesta);
    }

    /**
     * @Route("/buscar/{ltr}", name="app_buscarLetra")
     */
    public function buscarLetra($ltr) {
        $respuesta = "<html><body>Ningún alumno por la letra $ltr</body></html>";
        if($ltr == "todos") {
            return $this->render('ficha_contacto.html.twig',array("contacto"=>null,"contactos"=>$this->alumnos));
        }
        foreach($this->alumnos as $alumno) {
            if(strtolower(substr($alumno["apellido"],0,1)) == strtolower($ltr)) {
                $respuesta = "
                    <html>
                        <body>
                            <p>Nombre: ".$alumno["nombre"]."</p>
                            <p>Apellido: ".$alumno["apellido"]."</p>
                            <p>Edad: ".$alumno["edad"]."</p>  
                        </body>
                    </html>
                ";
                break;
            }
        }
        
        return new Response($respuesta);
    }

    /** 
     * @Route("/hola", name="app_hola") 
     */ 
    public function home_admin() { 
        return new Response('<html><body>Hola</body></html>'); 
    }

     /** 
     * @Route("/adios", name="app_adios") 
     */ 
    public function home_admin2() { 
        return new Response('<html><body>Adios.</body></html>'); 
    } 

    /**
    * @Route("/producto/{num1}/{num2}", name="app_producto")
    */
    public function producto($num1, $num2) {
        $producto = $num1 * $num2;
        return new Response("<html><body>$producto</body></html>");
    }

    /**
    * @Route("/defecto1/{num}", name="app_defecto1")
    */
    public function defecto1($num = 3) {
        return new Response("<html><body>$num</body></html>");
    }

    /**
    * @Route("/defecto2/{num?4}", name="app_defecto2")
    */
    public function defecto2($num) {
        return new Response("<html><body>$num</body></html>");
    }
    
    /**
    * @Route("/cuadrado/{num}", name="app_cuadrado")
    */
    public function cuadrado($num) {
        return $this->redirectToRoute('app_producto', array('num1'=>$num, 'num2'=>$num));
    }
}