<?php
        if(isset($_GET["nombre"])){
            if(empty($_GET["nombre"])){
                echo "Debe darle un valor a la variable 'nombre' en la URL o no ponga la variable 'nombre'";
            } else {
                $nombre = $_GET["nombre"];
                echo "Hola $nombre.";
            }
        } else {
            echo "Hola anónimo";
        }
?>