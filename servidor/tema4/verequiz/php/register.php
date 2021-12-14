<?php 
    $dsn = 'mysql:dbname=verequiz;host=localhost'; 
    $usuario = 'promotor'; 
    $clave = '123'; 
    $options = array( 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

try { 
    $dbh = new PDO($dsn, $usuario, $clave, $options); 

    class Usuario {
        public $nombre;
        public $correo;
        public $contrasenya;

        public function __construct($nombre,$correo,$contrasenya){
            $this->nombre = $nombre;
            $this->correo = $correo;
            $this->contrasenya = password_hash($contrasenya,PASSWORD_DEFAULT);
        }
    }

    $cliente = new Usuario($_POST["nombre"],$_POST["correo"],$_POST["contra"]);

    //PREPARE -> BIND -> EXECUTE 
    //Prepare 
    $stmt = $dbh->prepare("insert into usuario(nombre, correo, contrasenya) values(:nombre, :correo, :contrasenya)"); 

    //Execute
    if ($stmt->execute((array)$cliente)) {
        $_SESSION["user"] = $cliente->nombre;
        $_SESSION["correo"] = $cliente->correo;
        $_SESSION["puntuacion"] = 0;
        $_SESSION["correctasSeguidas"] = 0; 
        echo '0'; 
    }  
 
} catch (PDOException $e) {
    session_unset();
    session_destroy();
    setcookie(session_name(),123,time()-1000);
    echo $e; 
} finally { 
    if (isset($dbh)) { 
        $dbh = null;  
    } 
}