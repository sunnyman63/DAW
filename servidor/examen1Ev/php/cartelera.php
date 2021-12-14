<?php
        $dsn = 'mysql:dbname=examen;host=127.0.0.1'; 
        $usuario = 'root'; 
        $clave = ''; 
        $options = array( 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" 
    ); 
    try {  
        $dbh = new PDO($dsn, $usuario, $clave, $options);  
        $todo = Array();
        //PREPARE -> BIND -> EXECUTE 
        //Prepare 
        $stmt = $dbh->prepare("SELECT nombre FROM CINE"); 
        //Bind  
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //Execute 
        $stmt->execute();
        $cines = $stmt->fetchAll();
        array_push($todo,$cines);

        $stmt = $dbh->prepare("SELECT titulo FROM PELICULA"); 
        //Bind  
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //Execute 
        $stmt->execute();
        $peliculas = $stmt->fetchAll();
        array_push($todo,$peliculas);
    
        echo json_encode($todo);
         
    } catch (PDOException $e) { 
        echo $e; 
    } finally { 
        if (isset($dbh)) { 
            $dbh = null;  
        } 
    }
?>