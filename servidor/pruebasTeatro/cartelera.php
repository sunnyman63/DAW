<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./js/cartelera.js"></script>
    <title>Cartelera</title>
</head>
<body>
    <h1>Cartelera</h1>  
    <form action="#" method="POST">
        <label for="cine">Cine:</label>
        <select id="cine">
        <option value="default">=Cine=</option>
        </select>
        <label for="pelicula">Pelicula:</label>
        <select id="pelicula" disabled>
            <option>=Película=</option>
        </select>
        <label for="dia">Día:</label>
        <select id="dia" disabled>
            <option>=Día=</option>
        </select>
    </form>
    <div id="container">
        
    </div>
    

</body>
</html>