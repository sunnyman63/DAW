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
    <script src="scriptCartelera.js"></script>
    
    <form action="">
        Cine<input type="text" id="cine">
        Película<input type="text" id="peli">
        Dia<input type="date" id="dia">
        <p onclick="comprobarRegistro()">Filtrar</p>
    </form>
    <a href="indexUsu.php">volver</a>
    <a href="cerrarSesion.php">Cerrar Sesion</a>
</body>
</html>