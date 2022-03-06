<?php
    require_once "php/herramientas.php";

    if(!existeSesion()) {
        header("Location: login.php");
    }
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

    <?php
        if(esAdmin()) {
            echo "<h1>hola Admin!!</h1>";
        }

        if(noEsAdmin()) {
            echo "<h1>hola Usuario!!</h1>";
        }
    ?>

    <a href="./cartelera.php">Cartelera</a><br>

    <?php
        if(esAdmin()) {
    ?>
        <a href="./anyadirSesion.php">Añadir Sesión</a><br>
    <?php
        }

        if(noEsAdmin()) {
    ?>
        <a href="./comprarEntrada.php">Comprar entradas</a><br>
        <a href="./historico">Historico de entradas</a><br>
    <?php
        }
    ?>

    <a href="./logout.php" id="logout">Cerrar Sesión</a>

</body>
</html>