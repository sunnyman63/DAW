<?php 
    session_start();
    $cadenaConexion = 'mysql:dbname=verequiz;host=127.0.0.1'; 
    $usuario = 'promotor'; 
    $clave = '123'; 
    $options = array( 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" 
    );
    $ids = Array();
    $randNum = 0;

    if(isset($_POST["empieza"])) {
        if(isset($_SESSION["idPreg"])) {
            $_SESSION["idPreg"] = $ids;
            $_SESSION["puntuacion"] = 0;
            $_SESSION["correctasSeguidas"] = 0;  
        }
    }

    class pregunta {
        public $pregunta;
        public $resp1;
        public $resp2;
        public $resp3;
        public $resp4;
        public $tema;
        public $numPreg;
        public $puntuacion;

        public function __construct($pregunta,$resp1,$resp2,$resp3,$resp4,$tema,$num,$punt) {
            $this->pregunta = $pregunta;
            $this->resp1 = $resp1;
            $this->resp2 = $resp2;
            $this->resp3 = $resp3;
            $this->resp4 = $resp4;
            $this->tema = $tema;
            $this->numPreg = $num;
            $this->puntuacion = $punt;
        }
    }
    try { 
        $bd = new PDO($cadenaConexion, $usuario, $clave, $options);
        
        if($_SESSION["correctasSeguidas"] < 5) {

            $stmt = $bd->prepare('SELECT COUNT(*) AS numPreg FROM preguntas');
            $stmt->execute(); 
            $count = $stmt->fetch(PDO::FETCH_ASSOC);

            $randNum = random_int(1,$count["numPreg"]);

            if(isset($_SESSION["idPreg"])) {
                $ids = $_SESSION["idPreg"];
                while(array_search($randNum,$ids)!=false) {
                    $randNum = random_int(1,$count["numPreg"]);
                }
                array_push($ids,$randNum);
            } else {
                array_push($ids,$randNum);
            }
            $_SESSION["idPreg"]=$ids;

            $cat = "";

            if(isset($_POST["tema"])) {
                do {
                    $stmt = $bd->prepare('SELECT * FROM preguntas WHERE categoria=:cat ORDER BY RAND() LIMIT 1');
                    $stmt->bindParam(":cat",$_POST["tema"]);
                    $stmt->execute(); 
                    //Obtenemos todas las tuplas en un array 
                    //También podemos indicar el estilo de devolución 
                    $preg = $stmt->fetch(PDO::FETCH_OBJ);
                }
                while(array_search($preg->id,$ids)!=false);
                array_pop($ids);
                array_push($ids,$preg->id);    
            } else {
                $stmt = $bd->prepare('SELECT * FROM preguntas WHERE id=:id');
                $stmt->bindParam(":id",$randNum);

                $stmt->execute(); 
                //Obtenemos todas las tuplas en un array 
                //También podemos indicar el estilo de devolución 
                $preg = $stmt->fetch(PDO::FETCH_OBJ);
            }
            //Ejecutamos

            $pregunta = new pregunta($preg->pregunta,$preg->respuesta1,$preg->respuesta2,$preg->respuesta3,$preg->respuesta4,$preg->categoria,count($ids),$_SESSION["puntuacion"]);

            echo json_encode($pregunta);

        } else {
            $_SESSION["correctasSeguidas"] = 0;
            echo "elegir";
        }
           
    } catch (PDOException $e) {
        echo $e; 
    } finally { 
        if (isset($bd)) { 
            $bd = null; 
        } 
    }
?>