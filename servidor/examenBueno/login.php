<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script src="script2.js"></script>
<?php
//cada vez que vas al login la sesion se reinicia
    session_start();
    $_SESSION=array();
    setcookie(session_name(),123,time()-1000);
    session_destroy();
?>
    <form id="form">
        Nombre<input type="text" id="nombre">
        Contraseña<input type="password" id="pass">
        <p onclick="comprobarLogin()">Enviar</p>
    </form>
    <a href="registro.php">ir registro</a>
</body>
</html>