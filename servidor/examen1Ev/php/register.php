<?php
    session_start();
    $nom = $_POST["nombre"];
    $dni = $_POST["dni"];
    $correo = $_POST["correo"];
    $contra = $_POST["contra"];
    $contra2 = $_POST["contra2"];
    $dsn = 'mysql:dbname=examen;host=127.0.0.1'; 
    $usuario = 'root'; 
    $clave = ''; 
    $options = array( 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" 
    );

    class usuario {
        public $dni;
        public $nombre;
        public $mail;
        public $es_admin;
        public $password;

        public function __construct($dni, $nombre, $correo, $esAdmin, $contra){
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->mail = $correo;
            $this->es_admin = $esAdmin;
            $this->password = password_hash($contra,PASSWORD_BCRYPT, ['cost' => 13]);
        }
    }
try {  
    $dbh = new PDO($dsn, $usuario, $clave, $options);  
    //PREPARE -> BIND -> EXECUTE 
    //Prepare 
    $stmt = $dbh->prepare("SELECT * FROM USUARIO WHERE nombre=:nombre"); 
    //Bind  
    $stmt->bindParam(":nombre", $nom);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //Execute 
    $stmt->execute(); 
    
    $usuario = $stmt->fetch();

    if(empty($usuario)) {
        if($contra==$contra2) {
            $usu = new usuario($dni,$nom,$correo,false,$contra);
            $stmt = $dbh->prepare("INSERT INTO USUARIO (dni, nombre, mail, es_admin, password) VALUES (:dni, :nombre, :mail, :es_admin, :password)"); 
            //Bind  
            $stmt->execute((array)$usu);
            $_SESSION["user"] = $nom;
            $_SESSION["esAdmin"] = false;
            echo "0";
        } else {
            session_unset();
            session_destroy();
            setcookie(session_name(),123,time()-1000);
            echo "contras desiguales";
        }
    } else {
            session_unset();
            session_destroy();
            setcookie(session_name(),123,time()-1000);
            echo "usu existe";
    }
     
} catch (PDOException $e) { 
    echo $e; 
} finally { 
    if (isset($dbh)) { 
        $dbh = null;  
    } 
}
?>