<?php
    session_start();
    $_SESSION = [];
    setcookie(session_name(),123,time()-10000);
    session_destroy();
    setcookie("idiomaEjPreferencias",$_POST["lg"],-1000);
    setcookie("colorFondoEjPreferencias",$_POST["cf"],-1000);
    setcookie("colorLetraEjPreferencias",$_POST["cl"],-1000);
    header("Location: index.php");
?>