<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include ( 'ejc6.php'); ?>
    <table style='border:1px black solid'>
        <tr>
            <td style='border:1px black solid'><b>ID</b></td>
            <td style='border:1px black solid'><b>Nombre</b></td>
            <td style='border:1px black solid'><b>Edad</b></td>
        </tr>
        <?php
            foreach($alumnos as $alumno){
                echo "<tr>
                          <td style='border:1px black solid'>".$alumno["id"]."</td>
                          <td style='border:1px black solid'>".$alumno["nombre"]."</td>
                          <td style='border:1px black solid'>".$alumno["edad"]."</td>
                      </tr>";
            }
        ?>
    </table>
</body>
</html>


