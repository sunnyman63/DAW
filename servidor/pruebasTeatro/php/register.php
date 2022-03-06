<?php

require_once "clases/conexionBD.php";
require_once "clases/usuario.php";

$conexion = new conexionBD;
$usuario = new usuario;

$usuario->dni = $_POST["dni"];
$usuario->nombre = $_POST["nombre"];
$usuario->mail = $_POST["correo"];
$usuario->password = $_POST["contra"];

if($usuario->register($conexion) == "insertado") {
    echo 1;
} else {
    echo 2;
}