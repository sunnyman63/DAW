<?php
    if(isset($_GET["eu"])){
        if(empty($_GET["eu"])){
            echo "Debe darle un valor a la variable 'eu' en la URL<br>(Ejemplo: 'ejc3.php?eu=3')";
        } else {
            $euros = $_GET["eu"];
            echo "$euros euros equivalen a ".$euros/0.006." pesetas.";
        }
    } else {
        echo "Debe insertar ?eu= con un valor en la URL<br>(Ejemplo: 'ejc3.php?eu=3')";
    }
?>