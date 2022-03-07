<?php
    $dsn = 'mysql:dbname=examen;host=localhost';
    $usuario = 'root';
    $clave = '';
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => true //solo es persistente si se pasa somo array
    );
?>