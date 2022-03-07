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
        if(!isset($_SESSION["admin"])){
            header("Location:login.php");
        }
    ?>
    <a href="filtrarCarteleraAdmin.php">Ver cartelera</a>
    <a href="formSesion.php">Crear sesión</a>
    <a href="cerrarSesion.php">Cerrar Sesion</a>
</body>
</html>