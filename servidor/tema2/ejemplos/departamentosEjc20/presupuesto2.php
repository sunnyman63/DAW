<?php
    if(isset($_GET["submit"])) {        
        $dep = $_GET["dep"];
        switch($dep) {
            case "INFORMÁTICA":
                echo "INFORMÁTICA: 500 euros";break;
            case "LENGUA":
                echo "LENGUA: 300 euros";break;
            case "MATEMÁTICAS":
                echo "MATEMÁTICAS: 300 euros";break;
            case "INGLÉS":
                echo "INGLÉS: 400 euros";break;
        }
?>

<br>
<a href="presupuesto2.php">Volver</a>

<?php

    }else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamentos</title>
</head>
<body>
    <form action="presupuesto2.php" method="GET">
        <label>Seleccione el departamento al que pertenece:</label>
        <select name="dep">
            <option value="INFORMÁTICA">INFORMÁTICA</option>
            <option value="LENGUA">LENGUA</option>
            <option value="MATEMÁTICAS">MATEMÁTICAS</option>
            <option value="INGLÉS">INGLÉS</option>
        </select>
        <br>
        <input type="submit" name="submit" value="Enviar"/>
    </form>
</body>
</html>

<?php
    }
?>

