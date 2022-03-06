<?php
    require_once "php/herramientas.php";

    if(existeSesion()) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./js/register.js"></script>
    <title>Registro</title>
</head>
<body>
    <div id="container">
        <form action="#" method="post">
            <label for="dni">DNI:</label>
            <input type="text" id="dni">
            <br>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre">
            <br>
            <label for="correo">Correo:</label>
            <input type="text" id="correo">
            <br>
            <label for="contra">Contraseña:</label>
            <input type="password" id="contra">
            <br>
            <label for="contra2">Repita Contraseña:</label>
            <input type="password" id="contra2">
            <br>
            <input type="button" value="Registrarse" id="submit">
        </form>
        <a href="./login.php">Iniciar Sesión</a>
    </div>
    
</body>
</html>