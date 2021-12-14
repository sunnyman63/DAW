<!DOCTYPE html>
<?php require 'reentrante.php' ?>
<html>
<head>
 <title>Mis fechas</title>
</head>
<body>
<p><?php echo $mensaje; ?></p>
<form action="" method="POST">
    <label for="miNombre">Nombre 1:</label>
    <input type="text" name="miNombre" placeholder="Mi nombre" value="<?php echo
isset($miNombre)?$miNombre:"";?>">
    <label for="miFnac">Fecha de nacimiento 1:</label>
    <input type="date" name="miFnac" value="<?php echo isset($miFnac)?$miFnac:"";?>"><br>
    <label for="tuNombre">Nombre 2:</label>
    <input type="text" name="tuNombre" placeholder="Tu nombre" value="<?php echo
isset($tuNombre)?$tuNombre:"";?>">
    <label for="tuFnac">Fecha de nacimiento 2:</label>
    <input type="date" name="tuFnac" value="<?php echo isset($tuFnac)?$tuFnac:"";?>"><br>
    <input type="submit" value="Procesar fechas">
</form>
<p><?php echo $resultado; ?></p>
</body>
</html>