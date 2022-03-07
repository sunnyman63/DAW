<?php

require_once "clases/conexionBD.php";
require_once "clases/cine.php";

$conexion = new conexionBD;

if($_POST["tipo"] == "listarCines") {

    $cines = cine::todosLosCines($conexion);
    $resp = [
        "tipo" => "listarCines",
        "cines" => $cines
    ];
    echo json_encode($resp);

}

if($_POST["tipo"] == "listarPelis") {
    
    $pelis = cine::listarPelisPorCine($conexion,$_POST["cine"]);
    $resp = [
        "tipo" => "listarCines",
        "pelis" => $pelis
    ];
    echo json_encode($resp);
}