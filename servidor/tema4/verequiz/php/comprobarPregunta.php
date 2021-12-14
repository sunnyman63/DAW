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
        $stmt = $bd->prepare('SELECT respuestaCorrecta FROM preguntas WHERE id=:id');
        $id = end($_SESSION["idPreg"]);
        $stmt->bindParam(":id",$id); 
        //Ejecutamos 
        $stmt->execute(); 
        //Obtenemos todas las tuplas en un array 
        //También podemos indicar el estilo de devolución 
        $preg = $stmt->fetch(PDO::FETCH_ASSOC);

        if($_POST["respMarcada"] == $preg["respuestaCorrecta"]) {
            $_SESSION["correctasSeguidas"] +=1;
            $_SESSION["puntuacion"] += 1;
        } else {
            if($_SESSION["puntuacion"] >= 0.5) {
                $_SESSION["correctasSeguidas"] = 0;
                $_SESSION["puntuacion"] -= 0.5;
            } 
        }

        echo $preg["respuestaCorrecta"];
           
    } catch (PDOException $e) {
        echo $e; 
    } finally { 
        if (isset($bd)) { 
            $bd = null; 
        } 
    }
?>