<?php
    session_start();
    if(isset($_SESSION) && !empty($_SESSION)) {
        $resp = ["resp" => "0", "esAdmin" => $_SESSION["esAdmin"]];
        echo json_encode($resp);
    } else {
        session_unset();
        session_destroy();
        setcookie(session_name(),123,time()-1000);
        echo "no session";
    }

?>