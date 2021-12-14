<?php

    require_once "clases/BaseDatos.php";
    require_once "clases/usuario.php";

    $db = new BaseDatos;
    $usuario = Usuario::login2($db,$_POST["dni"],$_POST["contra"]);
    //print_r($usuario);
    if(!empty($usuario)) {
        switch($usuario->es_admin) {
            case 1: echo 2; break;
            case 0: echo 1; break;
        }
    } else {
        echo 0;
    }

?>