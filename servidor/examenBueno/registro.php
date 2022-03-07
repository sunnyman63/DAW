<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script src="script.js"></script>
    <form action=""  id="form">
        DNI<input type="text" required id="dni">
        Contraseña<input type="password" required id="pass">
        Email<input type="email" required id="email">
        Nombre<input type="text" required id="nombre">
        <p onclick="comprobarRegistro()">Enviar</p>
    </form>
    <a href="login.php">ir login</a>
    <a href="cerrarSesion.php">Cerrar Sesion</a>
</body>
</html>