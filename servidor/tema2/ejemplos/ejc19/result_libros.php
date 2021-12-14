<?php
    if(isset($_GET["submit"])) {
        if(empty($_GET["busqueda"]) || empty($_GET["lugar"]) || empty($_GET["genero"])){
            echo "Debe rellenar todos los datos!<br>";
            echo "<a href='form_libros.php'>Volver</a>";        
        } else {
            $busqueda = $_GET["busqueda"];
            $lugar = $_GET["lugar"];
            $genero = $_GET["genero"];
?>

<ul>
    <li>Texto de búsqueda: <?php printf($busqueda) ?></li>
    <li>Buscar en: <?php printf($lugar) ?></li>
    <li>Género: <?php printf($genero) ?></li>
</ul>
<br>
<a href="form_libros.php">Volver al formulario</a>

<?php
        }
    }else{
        echo "Debe rellenar todos los datos!<br>";
        echo "<a href='form_libros.php'>Volver</a>";
    }
?>