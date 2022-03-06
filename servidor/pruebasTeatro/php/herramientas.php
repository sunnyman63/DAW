<?php

session_start();

function existeSesion() {
    if(isset($_SESSION["usu"])) {
        return true;
    } else {
        return false;
    }
}

function esAdmin() {
    if($_SESSION["es_admin"] == 1) {
        return true;
    } else {
        return false;
    }
}

function noEsAdmin() {
    if($_SESSION["es_admin"] == 0) {
        return true;
    } else {
        return false;
    }
}
