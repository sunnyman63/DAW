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
        $stmt = $bd->prepare('INSERT INTO preguntas(pregunta,respuesta1,respuesta2,respuesta3,respuesta4,respuestaCorrecta,categoria) VALUES (:pregunta, :resp1, :resp2, :resp3, :resp4, :respCorrecta, :cat)');
        $stmt->bindParam(":pregunta",$_POST["pregunta"]);
        $stmt->bindParam(":resp1",$_POST["resp1"]);
        $stmt->bindParam(":resp2",$_POST["resp2"]);
        $stmt->bindParam(":resp3",$_POST["resp3"]);
        $stmt->bindParam(":resp4",$_POST["resp4"]);
        $stmt->bindParam(":respCorrecta",$_POST["respCorrecta"]);
        $stmt->bindParam(":cat",$_POST["cat"]);
         
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