<?php
    require_once "clases/conexionBD.php";
    require_once "clases/calendario.php";

    $msg = "";

    if(!empty($_POST["submit"])) {

        $conexion = new conexionBD;
        $query = "INSERT INTO calendario (nombre) VALUES (?)";
        $datos = array($_POST["nombre"]);
        $conexion->prepararInsercion($query,$datos);
        $msg = "Creada con exito";

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Calendario</title>
</head>
<body>
    <p><?= $msg ?></p>
    <form action="crearCalendario.php" method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br>
        <input type="submit" name="submit" value="submit">
    </form>
    <a href="./index.php">Volver Atrás</a>
</body>
</html>