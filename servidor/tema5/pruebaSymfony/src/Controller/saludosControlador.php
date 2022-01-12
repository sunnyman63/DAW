<?php 
//src/Controller/saludosControlador.php 
namespace App\Controller; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/base")
 */
class saludosControlador extends AbstractController { 

    private $alumnos = [
        [
            "nombre"=>"Javi",
            "apellido"=>"Prima",
            "edad"=>22
        ],
        [   "nombre"=>"Deivyth",
            "apellido"=>"Sarchi",
            "edad"=>21
        ],
        [   "nombre"=>"Alex",
            "apellido"=>"Romero",
            "edad"=>21
        ]
    ];

    /**
     * @Route("/buscar/{num<\d+>}", name="app_buscarId")
     */
    public function buscar($num) {
        $respuesta = "";
        if($num>-1 && $num<count($this->alumnos)){
            $respuesta = 
                "<html>
                    <body>
                        <p>Nombre: ".$this->alumnos[$num]["nombre"]."</p>
                        <p>Apellido: ".$this->alumnos[$num]["apellido"]."</p>
                        <p>Edad: ".$this->alumnos[$num]["edad"]."</p>    
                    </body>
                </html>"
            ;
        } else {
            $respuesta = "<html><body>No existen alumnos con esa ID.</body><html>";
        }
        
        return new Response($respuesta);
    }

    /**
     * @Route("/buscar/{ltr}", name="app_buscarLetra")
     */
    public function buscarLetra($ltr) {
        $respuesta = "<html><body>Ningún alumno por la letra $ltr</body></html>";
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