<?php
    session_start();

    function cerrarSesion() {
        session_unset();
        session_destroy();
        setcookie(session_name(),123,time()-1000);
    }

    if($_POST["tipo"] == "comprobar") {
        if(isset($_SESSION) && !empty($_SESSION)) {
            echo true;
        } else {
            cerrarSesion();
            echo false;
        }
    } else if($_POST["tipo"] == "cerrar") {
        cerrarSesion();
        echo false;
    }
?>