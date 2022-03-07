<?php
    require_once "clases/conexionBD.php";
    require_once "clases/calendario.php";
    require_once "clases/evento.php";

    $msg = "";
    $conexion = new conexionBD;

    if(!empty($_POST["submit"])) {

        $evento = new evento($_POST["nombre"],$_POST["fechaHora"],$_POST["tipo"],$_POST["urgencia"],$_POST["localizacion"],$_POST["id_calendario"]);
        $query = "SELECT * FROM calendario WHERE id=?";
        $datos = array($_POST["id_calendario"]);
        $calendario = $conexion->prepararSelectObjetos($query,$datos,calendario::class);
        $calendario[0]->agregarEvento($conexion,$evento);
        $msg = "Insertado con exito";

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
    <form action="crearEvento.php" method="POST">
        <label>Calendario:</label><select name="id_calendario">
        <?php  
            $query = "SELECT * FROM calendario";
            $datos = [];
            $calendarios = $conexion->prepararSelectArrays($query,$datos);
            foreach($calendarios as $calendario) {
        ?>
            <option value="<?=$calendario[0]?>"><?=$calendario[1]?></option>
        <?php
            }
        ?>
        </select><br>
        
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br>
        <label>Fecha y Hora (dd/mm/yy hh:mm:ss):</label><br>
        <input type="text" name="fechaHora" required><br>
        <label>Tipo (urgente o social):</label><br>
        <input type="text" name="tipo" required><br>
        <label>Urgencia:</label><br>
        <input type="text" name="urgencia"><br>
        <label>Localización:</label><br>
        <input type="text" name="localizacion"><br>
        <input type="submit" name="submit" value="submit">
    </form>
    <a href="./index.php">Volver Atrás</a>
</body>
</html>