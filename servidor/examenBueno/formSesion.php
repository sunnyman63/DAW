<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script src="sesiones.js"></script>
<?php
    session_start();
        if(!isset($_SESSION["admin"])){
            header("Location:login.php");
        }
    ?>
    <form action="">
        Sala<input type="number" max="5" min="0" id="sala">
        Pelicula<select name="asd" id="peli">
            <option value="La vida de mi ordenador">La vida de mi ordenador</option>
            <option value="No sin mi Apache">No sin mi Apache</option>
            <option value="Los routers de Maddison">Los routers de Maddison</option>
            <option value="Indiana Jones y el compilador maldito">Indiana Jones y el compilador maldito</option>
            <option value="Todo sobre mi Netbeans">Todo sobre mi Netbeans</option>
            <option value="Nadie hablará de nosotras cuando estemos desfasada...">Nadie hablará de nosotras cuando estemos desfasada...</option>
            <option value="El depurador indomable">El depurador indomable</option>
            <option value="La ram">La ram</option>
            <option value="Misterioso formateo en Manhattan"> 	Misterioso formateo en Manhattan</option>
            <option value="Absolescencia programada">Absolescencia programada</option>
        </select>
        Cine<select name="asd" id="cine">
            <option value="La Vereda multicines">La Vereda multicines</option>
            <option value="Servidorpolis">Servidorpolis</option>
            <option value="ABC el backend">ABC el backend</option>
          
        </select>
        Dia<input type="date" id="dia">
        Hora<input type="time" id="hora">
        <p onclick="crearSesion()">Crear</p>
   
    </form>
    <a href="cerrarSesion.php">Cerrar Sesion</a>
</body>
</html>