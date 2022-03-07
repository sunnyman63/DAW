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
    session_start();
        if(!isset($_SESSION["login"])){
            header("Location:login.php");
        }
    ?>
    <a href="filtrarCartelera.php">Ver cartelera</a>
    <a href="">Comprar Entradas</a>
    <a href="mostrarHistorico.php">Histórico de Entradas</a>
    <a href="cerrarSesion.php">Cerrar Sesion</a>
</body>
</html>