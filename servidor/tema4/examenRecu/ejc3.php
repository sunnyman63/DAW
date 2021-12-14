<?php
    if(isset($_POST["enviar"])) {
        $fecha1 = new DateTime($_POST["fecha1"]);
        $fecha2 = new DateTime($_POST["fecha2"]);
        $diff = $fecha1->diff($fecha2);
        $intervalo = new DateInterval("P".$_POST["intervalo"]."D");
        $periodo = new DatePeriod($fecha1,$intervalo,$diff->format("%d"));

        echo "Fecha inicio".$fecha1->format("d-m-y")." fecha fin ".$fecha2->format("d-m-y")." números días ".$_POST["intervalo"]."<br><br>";

        foreach($periodo as $fecha) {
            if($fecha > $fecha2) {
                break;
            } else {
                echo $fecha->format("d-m-y")."<br>";
            }
        }
    } else {
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
    <form method="POST" action="#">
        <label>Fecha 1: </label>
        <input type="date" name="fecha1" required>
        <label>&nbsp;&nbsp;&nbsp;&nbsp;Fecha 2: </label>
        <input type="date" name="fecha2" required><br>
        <label>Intervalo de días: </label>
        <input type="number" name="intervalo" min="1" value="1"><br>
        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>
<?php
    }
?>