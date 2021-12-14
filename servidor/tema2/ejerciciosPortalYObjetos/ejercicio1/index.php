<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="csss/estiloheader.css" rel="stylesheet">
    <link href="csss/estilocuerpo.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link href="csss/estilofooter.css" rel="stylesheet">
    <title>Preferencias</title>
</head>
<body>
<?php
    
    require_once "comunes/header.html";
    if(isset($_COOKIE["idiomaEjPreferencias"]) && isset($_COOKIE["colorFondoEjPreferencias"]) && isset($_COOKIE["colorLetraEjPreferencias"])) {
        $lg = $_COOKIE["idiomaEjPreferencias"];
        header("Location:login.php?lg=$lg");
        die();
    } else {
        if(isset($_POST["submit"])){
            setcookie("idiomaEjPreferencias",$_POST["lg"],time() + 86400);
            setcookie("colorFondoEjPreferencias",$_POST["cf"],time() + 86400);
            setcookie("colorLetraEjPreferencias",$_POST["cl"],time() + 86400);
            $lg = $_POST["lg"];
            header("Location:login.php?lg=$lg");
            die();
        } else {
            
?>
    <div class="cuerpo">
<?php
print_r($_COOKIE);
?>
        <form action="index.php" method="post">
            <label>Idioma predeterminado: </label>
            <select name="lg">
                <option value="es">Español</option>
                <option value="en">Inglés</option>
            </select>
            <br>
            <label>Color de fondo de la página: </label>
            <input type="color" name="cf" value="#ffffff">
            <br>
            <label>Color de letra: </label>
            <input type="color" name="cl" value="#000000">
            <br>
            <br>
            <input type="submit" name="submit" value="Enviar">
        </form>
    </div>

<?php
        }
    }
    require_once "comunes/footer.html";
?>  
</body>
</html>

