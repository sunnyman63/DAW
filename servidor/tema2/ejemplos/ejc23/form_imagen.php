<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir una imagen</title>
</head>
<body>
    <form action="subir_imagen.php" method="POST" enctype="multipart/form-data">
        <label>Seleccione una imagen:</label>
        <input type="file" name="fichero"/>
        <br>
        <input type="submit" name="submit" value="Enviar"/>
    </form>
</body>
</html>