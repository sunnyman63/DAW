<?php

    function existeSesion() {
        if(isset($_SESSION["usu"])) {
            return true;
        } else {
            CerrarSesion();
            return null;
        }
    }

    function esAdmin() {
        if(existeSesion()==true) {
            $esAdmin = $_SESSION["esRey"];
            if($esAdmin == 1) {
                header("Location: ./administracion.php");
            }
        } else {
            header("Location: ./");
        }
    }

    function noEsAdmin() {
        if(existeSesion()==true) {
            $esAdmin = $_SESSION["esRey"];
            if($esAdmin == 0) {
                header("Location: ./inicio.html");
            }
        }
        else {
            header("Location: ./");
        }
    }

    function cerrarSesion() {
        session_unset();
        session_destroy();
        setcookie(session_name(),123,time()-1000);
    }

?>