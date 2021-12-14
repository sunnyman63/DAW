<?php 
    $dsn = "mysql:host=localhost;dbname=Ejemplo"; 
    $usuario = 'promotor'; 
    $clave = '123'; 
    try { 
        $dbh = new PDO($dsn, $usuario, $clave); 
        echo 'Conexión realizada con éxito'; 
        $dbh = null; //así se cierra 
    } catch (PDOException $e) { 
        echo 'Error con la base de datos: ' . $e->getMessage(); 
    }