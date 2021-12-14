<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="csss/estiloheader.css" rel="stylesheet">
    <link href="csss/estilocuerpo.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link href="csss/estilofooter.css" rel="stylesheet">
    <title>Registrate en Verelibros</title>
</head>
<body>
<?php
    require_once "comunes/header.html";
?>
    <div class="cuerpo">
        <div class="div_error">
<?php 
    if(isset($_COOKIE["error"])) {
        echo "*".$_COOKIE["error"];
    }
?>
        </div>
        <form action="comprobarCredenciales.php" method="POST" autocomplete="off">
            <input type="hidden" name="tp" value="re">
            <label>Nombre</label><br><input type="text" name="nombre" required><br>
            <label>Correo</label><br><input type="email" name="correo" required><br>
            <label>Contraseña</label><br><input type="password" name="contra" required><br>
            <label>Repetir contraseña</label><br><input type="password" name="contrarep" required><br>
            <br>
            <input type="submit" name="submit" value="Registrarse">
            <a href="login.php">Iniciar Sesión</a>
        </form>
    </div>  
<?php 
    require_once "comunes/footer.html";
?>  
</body>
</html>