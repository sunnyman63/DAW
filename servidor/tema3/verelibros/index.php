<?php
    session_start();
    if(isset($_SESSION["user"])) {
        if($_SESSION["esAdmin"]==false) {
            header("Location:pagina.php");
        }
    } else {
        $_SESSION = array();
        session_destroy();
        setcookie(session_name(),123,time()-10000);
        header("Location:login.php");
    }

?>