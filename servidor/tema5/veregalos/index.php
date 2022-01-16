<?php
    session_start();

    require_once "./bootstrap.php"; 
    require_once "./src/Entity/Usuario.php";
    require_once "./src/Entity/Regalo.php";
    require_once "./seguridad.php";

    if(isset($_POST["submit"])) {
        if(!empty($_POST["user"]) && !empty($_POST["contra"])) {
            $log = Usuario::login($em,$_POST["user"],$_POST["contra"]);
            if(!empty($log)) {
                $_SESSION["usu"] = $log->nick;
                $_SESSION["correo"] = $log->correo;
                $_SESSION["esRey"] = $log->esRey;
                header("Location: ./inicio.php");
            } else {
                echo "<script>alert('Usuario o Contraseña invalidos.');</script>";
            }
        }
    }

    if(existeSesion()==true) {
        header("Location: ./inicio.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="./css/estiloEntrada.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <form action="#" method="POST" class="formulario">
            <input type="text" name="user" placeholder="Usuario" class="text" required>
            <input type="password" name="contra" placeholder="Contraseña" class="text" required>
            <input type="submit" name="submit" value="Entrar" class="btnForm">
            <p>No tienes cuenta? <a href="./registro.php">Registrate ahora!!</a></p>
        </form>
    </div>
</body>
</html>