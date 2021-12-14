<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de libros</title>
</head>
<body>
    <form action="result_libros.php" method="GET">
        <label>Texto de búsqueda:</label>
        <input type="text" name="busqueda"/>
        <br>
        <label>Buscar en:</label>
        <input type="radio" id="libro" name="lugar" value="Título del libro"/>
        <label for="libro">Título del libro</label>
        <input type="radio" id="autor" name="lugar" value="Nombre del autor"/>
        <label for="autor">Nombre del autor</label>
        <input type="radio" id="editorial" name="lugar" value="Editorial"/>
        <label for="editorial">Editorial</label>
        <br>
        <label>Tipo de libro:</label>
        <select name="genero">
            <option value="Narrativa">Narrativa</option>
            <option value="Libros de texto">Libros de texto</option>
            <option value="Guías y mapas">Guías y mapas</option>
        </select>
        <br>
        <input type="submit" name="submit" value="Buscar"/>
    </form>
</body>
</html>