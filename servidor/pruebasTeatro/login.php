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
    <script src="./js/login.js"></script>
    <title>Iniciar Sesión</title>
</head>
<body>
    <div id="container">
        <form action="#" method="post">
            <label for="dni">DNI:</label>
            <input type="text" id="dni">
            <br>
            <label for="contra">Contraseña:</label>
            <input type="password" id="contra">
            <br>
            <input type="button" value="Iniciar" id="submit">
        </form>
        <a href="./register.php">Registrarse</a>
    </div>
</body>
</html>