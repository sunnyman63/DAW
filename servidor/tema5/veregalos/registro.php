<?php
    session_start();

    require_once "./bootstrap.php"; 
    require_once "./src/Entity/Usuario.php";
    require_once "./src/Entity/Regalo.php";
    require_once "./seguridad.php";

    if(isset($_POST["submit"])) {
        if(!empty($_POST["user"]) && !empty($_POST["correo"]) && !empty($_POST["contra"]) && !empty($_POST["contra2"])) {
            if($_POST["contra"]==$_POST["contra2"]) {
                $randnum = random_int(1,100);
                $log = new Usuario($_POST["user"],$_POST["correo"],$_POST["contra"],$randnum,0);
                $rsp = $log->insertarUsuario($em);
                if($rsp==1) {
                    $_SESSION["usu"] = $log->nick;
                    $_SESSION["correo"] = $log->correo;
                    $_SESSION["esRey"] = $log->esRey;
                    header("Location: ./inicio.php");
                } else {
                    echo "<script>alert('Nombre de usuario ya en uso.');</script>";
                }
            } else {
                echo "<script>alert('Las contraseñas deben coincidir.');</script>";
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
        <h1>Regístrate Gratis</h1>
        <form action="#" method="POST" class="formulario">
            <input type="text" name="user" placeholder="Usuario" class="text">
            <input type="email" name="correo" placeholder="example@mail.com" class="text">
            <input type="password" name="contra" placeholder="Contraseña" class="text">
            <input type="password" name="contra2" placeholder="Repita Contraseña" class="text">
            <input type="submit" name="submit" value="Entrar" class="btnForm">
            <p>Ya tienes cuenta? <a href="./index.php">Inicia sesión!!</a></p>
        </form>
    </div>
</body>
</html>