<?php
    session_start();
    if(isset($_GET["lg"]) && isset($_COOKIE["idiomaEjPreferencias"]) && isset($_COOKIE["colorFondoEjPreferencias"]) && isset($_COOKIE["colorLetraEjPreferencias"])){
        if(empty($_GET["lg"])){
            echo "Fatal Error!!";
            die();
        }else {
            if($_GET["lg"]==$_COOKIE["idiomaEjPreferencias"]) {
                require_once "comunes/leng_".$_GET["lg"].".php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="csss/estiloheader.css" rel="stylesheet">
    <link href="csss/estilocuerpo.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link href="csss/estilofooter.css" rel="stylesheet">
    <style>
        .cuerpo {
            background-color: <?=$_COOKIE["colorFondoEjPreferencias"]?>;
            color: <?=$_COOKIE["colorLetraEjPreferencias"]?>;
        }
    </style>
    <title><?=$tituloPagina?></title>
</head>
<body>
<?php
    require_once "comunes/header.html";
?>
<div class="cuerpo">
    <h1><?=$saludo.$_SESSION["user"]."!!"?></h1><br>
    <p>(<?=$_SESSION["email"]?>)</p><br>
    <div>
        <img src="<?=$_SESSION["ico"]?>" width="100px" height="100px"><br>
        <a href="borrarCookies.php"><?=$linkBorrarCookies?></a> /
        <a href="cerrarSesion.php"><?=$linkCerrarSesion?></a>
    </div>
</div>  
<?php 
    require_once "comunes/footer.html";
?>  
</body>
</html>
<?php
            } else {
                header("Location:pagina.php?lg=".$_COOKIE["idiomaEjPreferencias"]);
            } 
        }
    } else {
        echo "Fatal Error!!";
        die();
    }
?>