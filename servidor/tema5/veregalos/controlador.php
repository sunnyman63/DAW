<?php

    require_once "./bootstrap.php"; 
    require_once "./src/Entity/Usuario.php";
    require_once "./src/Entity/Regalo.php";

    if(isset($_POST["razon"])) {
        switch($_POST["razon"]) {
            case "regalos":
                echo json_encode(Regalo::listarTodosLosRegalos($em));
                break;
        }
    }

    

?>