<?php

    session_start();

    require_once "./seguridad.php";

    esAdmin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="./css/estiloMenu.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script src="./js/menuInicio.js"></script>
</head>
<body>
    <div id="container" class="container">
        <h1>Que quieres hacer?</h1>
        <button id="carta" class="btnMenu">
            <i class="fas fa-envelope-open-text"></i>
            <p>Hacer la Carta</p>
        </button>
        <button id="recibidos" class="btnMenu">
            <i class="fas fa-gifts"></i>
            <p>Ver lo recibido</p>
        </button>
    </div>
</body>
</html>