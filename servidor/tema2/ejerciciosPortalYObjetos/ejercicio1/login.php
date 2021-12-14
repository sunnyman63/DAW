<?php
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
    <title><?=$tituloLogin?></title>
</head>
<body>
<?php
    require_once "comunes/header.html";
?>
<div class="cuerpo">
   <form action="comprobarCredenciales.php" method="POST">
       <input type="hidden" name="tp" value="lo">
       <label><?=$nombre?></label><br><input type="text" name="nombre"><br>
       <label><?=$contra?></label><br><input type="password" name="contra"><br>
       <br>
       <input type="submit" name="submit" value="<?=$botonLogin?>"><br>
       <a href="register.php?lg=<?=$_COOKIE["idiomaEjPreferencias"]?>"><?=$linkLoginToRegister?></a> /
       <a href="borrarCookies.php"><?=$linkBorrarCookies?></a>
   </form>
</div>  
<?php 
    require_once "comunes/footer.html";
?>  
</body>
</html>
<?php
        if(strcmp($_COOKIE["errorLogin"],"ContraMal")==0) {
            echo "<script languaje='javascript'>alert('Contraseña Incorrecta.');</script>";
        }
        if(strcmp($_COOKIE["errorLogin"],"UserNoExiste")==0) {
            echo "holi";
            echo "<script languaje='javascript'>alert('usuario no Encontrado.');</script>";
        }
            } else {
                header("Location:login.php?lg=".$_COOKIE["idiomaEjPreferencias"]);
            } 
        }
    } else {
        header("Location:index.php");
        die();
    }
?>
