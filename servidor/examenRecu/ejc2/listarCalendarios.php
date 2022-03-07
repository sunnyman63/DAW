<?php
    require_once "clases/conexionBD.php";
    require_once "clases/calendario.php";
    require_once "clases/evento.php";

    $conexion = new conexionBD;
    $calendarios = calendario::listarCalendarios($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        echo "<pre>";
        print_r($calendarios);
        echo "</pre>";
    ?>
</body>
</html>