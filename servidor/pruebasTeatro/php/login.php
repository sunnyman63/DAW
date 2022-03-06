<?php

session_start();

require_once "clases/conexionBD.php";
require_once "clases/usuario.php";

$conexion = new conexionBD;

$usu = new usuario;
$usu->dni = $_POST["dni"];
$usu->password = $_POST["contra"];

$resp = $usu->login($_POST["dni"],$_POST["contra"],$conexion);

if(!empty($resp)) {
    $_SESSION["usu"] = $_POST["dni"];
    $_SESSION["es_admin"] = $resp[3];
    echo 1;
} else {
    session_unset();
    session_destroy();
    setcookie(session_name(),123,time()-1000);
    echo 2;
}