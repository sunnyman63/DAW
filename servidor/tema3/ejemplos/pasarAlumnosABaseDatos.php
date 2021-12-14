<?php
    $fichero = file("alumnos.txt");

    $dsn = 'mysql:dbname=EjercicioOnceTemaDosAhoraTres;host=localhost';
    $usuario = 'promotor'; 
    $clave = '123'; 
    $options = array( 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" );

    try {  
        $dbh = new PDO($dsn, $usuario, $clave, $options); 
        echo 'Conexión realizada con éxito<br>';
    
        //PREPARE -> BIND -> EXECUTE
        //Prepare 
        $stmt = $dbh->prepare("insert into alumno(usuario, estudios) values(?, ?)"); 
    
        //Bind
        $stmt->bindParam(1, $usuario); 
        $stmt->bindParam(2, $estudios);

        foreach($fichero as $linea) {
            $usuario = substr($linea,0,strpos($linea," "));
            $estudios = substr($linea,strpos($linea," "));
            $stmt->execute();
        }

        echo "Usuarios añadidos correctamente.";

    } catch (PDOException $e) { 
        echo 'Error con la base de datos: ' . $e->getMessage(). '<br>'; 
    } finally { 
        if (isset($dbh)) { 
            $dbh = null; 
            echo 'Desconexión realizada con éxito!'; 
        } 
    }
?>