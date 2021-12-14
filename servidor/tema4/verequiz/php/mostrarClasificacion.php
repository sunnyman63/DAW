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
        $stmt = $bd->prepare('SELECT * FROM clasificacion ORDER BY puntuacion DESC');

        //Ejecutamos 
        $stmt->execute(); 
        //Obtenemos todas las tuplas en un array 
        //También podemos indicar el estilo de devolución 

        $clasi = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($clasi);
        
    } catch (PDOException $e) {
        echo $e; 
    } finally { 
        if (isset($bd)) { 
            $bd = null; 
        } 
    }
?>