<?php
    session_start();
    $cadenaConexion = 'mysql:dbname=verequiz;host=127.0.0.1'; 
    $usuario = 'promotor'; 
    $clave = '123'; 
    $options = array( 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" 
    );

    try { 
        $bd = new PDO($cadenaConexion, $usuario, $clave, $options);

        //FETCH_OBJ 
        $stmt = $bd->prepare('INSERT INTO clasificacion VALUES (:nomUsu, :pts, :fecha)');
        $stmt->bindParam(":nomUsu",$_SESSION["user"]);
        $stmt->bindParam(":pts",$_SESSION["puntuacion"]);
        $fecha = new DateTime();
        $fechabuena = $fecha->format("Y-m-d H:i:s");
        $stmt->bindParam(":fecha",$fechabuena);  
        //Ejecutamos 
        $stmt->execute();
        
    } catch (PDOException $e) {
        echo $e; 
    } finally { 
        if (isset($bd)) { 
            $bd = null; 
        } 
    }
?>