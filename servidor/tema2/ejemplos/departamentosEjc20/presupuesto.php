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
<a href="form_dep.php">Volver</a>

<?php

    }else{
        echo "Error Fatal!!";
    }
?>