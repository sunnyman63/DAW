<?php

    setcookie("idiomaEjPreferencias",$_POST["lg"],-1000);
    setcookie("colorFondoEjPreferencias",$_POST["cf"],-1000);
    setcookie("colorLetraEjPreferencias",$_POST["cl"],-1000);
    header("Location:cerrarSesion.php");

?>