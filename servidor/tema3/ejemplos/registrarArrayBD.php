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
    //PREPARE -> BIND -> EXECUTE 
    //Prepare 
    $stmt = $dbh->prepare("insert into Alumnos(Nombre, Apellidos, Edad) values(:nombre, :apellidos, :edad)"); 
    //Bind 
    $nombre = "Deivyth"; 
    $apellidos = "Sarchi Mena"; 
    $edad = 21;

    //Execute
    if ($stmt->execute(array(':nombre'=>$nombre, ':apellidos'=>$apellidos, ':edad'=>$edad))) { 
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
?>