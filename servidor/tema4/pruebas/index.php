<?php
    $fichero = file("preguntas.txt");

    $dsn = 'mysql:dbname=verequiz;host=localhost';
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
        $stmt = $dbh->prepare("insert into preguntas(pregunta, respuesta1, respuesta2, respuesta3, respuesta4, respuestaCorrecta, categoria) values(?, ?, ?, ?, ?, ?, ?)"); 
    
        //Bind
        $stmt->bindParam(1, $pregunta); 
        $stmt->bindParam(2, $resp1);
        $stmt->bindParam(3, $resp2); 
        $stmt->bindParam(4, $resp3);
        $stmt->bindParam(5, $resp4); 
        $stmt->bindParam(6, $respCor);
        $stmt->bindParam(7, $tema); 
        
        foreach($fichero as $linea) {
            $lineaArray = explode(";",$linea);
            $pregunta = $lineaArray[0];
            $resp1 = $lineaArray[1];
            $resp2 = $lineaArray[2];
            $resp3 = $lineaArray[3];
            $resp4 = $lineaArray[4];
            $respCor = $lineaArray[5];
            $tema = trim($lineaArray[6],"\n");
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