<?php

    session_start();

    require_once "./bootstrap.php"; 
    require_once "./src/Entity/Usuario.php";
    require_once "./src/Entity/Regalo.php";
    require_once "./seguridad.php";

    noEsAdmin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Estamos en administración</h1>
</body>
</html>