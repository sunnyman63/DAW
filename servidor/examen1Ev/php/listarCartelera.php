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
        $stmt = $dbh->prepare("SELECT * FROM PROYECCION"); 
        //Bind  
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //Execute 
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $linea = Array();
            //Prepare 
            $stmt2 = $dbh->prepare("SELECT nombre FROM CINE WHERE cod_cine=:cod_cine"); 
            //Bind  
            $stmt2->bindParam(":cod_cine",$row["cod_cine"]);
            $stmt2->setFetchMode(PDO::FETCH_ASSOC);
            //Execute 
            $stmt2->execute();
            $cine = $stmt2->fetch();
            array_push($linea,$cine["nombre"]);

            array_push($linea,$row["num_sala"]);

            //Prepare 
            $stmt2 = $dbh->prepare("SELECT titulo FROM PELICULA WHERE cod_peli=:cod_peli"); 
            //Bind  
            $stmt2->bindParam(":cod_peli",$row["cod_peli"]);
            $stmt2->setFetchMode(PDO::FETCH_ASSOC);
            //Execute 
            $stmt2->execute();
            $peli = $stmt2->fetch();
            array_push($linea,$peli["titulo"]);

            array_push($linea,$row["horario"]);

            array_push($todo,$linea);
        }

        echo json_encode($todo);
    
    } catch (PDOException $e) { 
        echo $e; 
    } finally { 
        if (isset($dbh)) { 
            $dbh = null;  
        } 
    }
?>