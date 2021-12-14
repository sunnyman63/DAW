<?php 
    $dsn = 'mysql:dbname=Ejemplo;host=localhost'; 
    $usuario = 'promotor'; 
    $clave = '123'; 
    $options = array( 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

try { 
    $dbh = new PDO($dsn, $usuario, $clave, $options); 
    echo 'Conexión realizada con éxito<br>';

    class Alumnos {
        public $nombre;
        public $apellidos;
        public $edad;

        public function __construct($nombre,$apellidos,$edad){
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->edad = $edad;
        }
    }

    $alumno = new Alumnos("Maria","Paricio Paricio",21);

    //PREPARE -> BIND -> EXECUTE 
    //Prepare 
    $stmt = $dbh->prepare("insert into Alumnos(Nombre, Apellidos, Edad) values(:nombre, :apellidos, :edad)"); 

    //Execute
    if ($stmt->execute((array)$alumno)) { 
        echo 'Se ha creado el nuevo registro!<br>'; 
    }  
 
} catch (PDOException $e) { 
    echo 'Error con la base de datos: ' . $e->getMessage() . '<br>'; 
} finally { 
    if (isset($dbh)) { 
        $dbh = null; 
        echo 'Desconexión realizada con éxito!'; 
    } 
}