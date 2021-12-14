<?php

    require_once "clases/BaseDatos.php";
    require_once "clases/usuario.php";

    $db = new BaseDatos;
    $usuario = new Usuario($_POST["dni"],$_POST["contra"],$_POST["nombre"],$_POST["email"]);
    //print_r($usuario);
    if(empty($usuario->insertarUsuario($db))) {
        echo 1;
    } else {
        echo 0;
    }

?>