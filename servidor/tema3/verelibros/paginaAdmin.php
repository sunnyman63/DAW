<?php
    session_start();
    $cadError = "";
    require_once "funcionesBuscarLibro.php";
    $cadenaConexion = 'mysql:dbname=verelibros;host=127.0.0.1'; 
    $usuario = 'promotor'; 
    $clave = '123'; 
    $options = array( 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" 
    );
    if(!isset($_SESSION["user"])) {
        $_SESSION = array();
        session_destroy();
        setcookie(session_name(),123,time()-10000);
        header("Location: index.php");
    }
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
    <title>verelibros</title>
</head>
<body>
<?php
    require_once "comunes/header.html";
?>
<div class="cuerpo">
    <div class="div_error">
<?php 
    if(isset($_COOKIE["error"])) {
        echo "*".$_COOKIE["error"];
    }
?>
    </div>
    <form action="paginaAdmin.php" method="POST" autocomplete="off">
        <label>Buscar por: </label>
        <select name="buscarPor">
            <option value="ninguno">Elija uno</option>
            <option value="titulo">Título</option>
            <option value="autor">Autor</option>
            <option value="isbn">ISBN</option>
        </select>
        <input type="text" name="buscarPorText"><br>
        <label>Ordenar por:</label>
        <select name="ordenarPor">
            <option value="titulo">Título</option>
            <option value="isbn">ISBN</option>
            <option value="anyo_publicacion">Fecha</option>
            <option value="precio">Precio</option>
        </select><br>
        <input type="submit" name="submit" value="Buscar">
    </form>
    <div class="listaLibros">
        <table>
            <tr class="titulosTabla">
                <td class="texts">Nombre</td>
                <td class="texts">Autor</td>
                <td class="nums">Isbn</td>
                <td class="nums">Fecha</td>
                <td class="nums">Precio</td>
            </tr>
<?php
    $noRes = false;
    try { 
        $dbh = new PDO($cadenaConexion, $usuario, $clave, $options);
        //PREPARE -> BIND -> EXECUTE
        if(isset($_POST["submit"])) {
            if($_POST["buscarPor"] == "ninguno") {
                todosLosLibros($dbh,$_POST["ordenarPor"],$noRes);
            } else {
                if(empty($_POST["buscarPorText"])) {
                    $cadError = "Debe insertar el ".$_POST["buscarPor"]." a buscar.";
                } else {
                    if($_POST["buscarPor"]=="autor") {
                        buscarPorAutor($dbh,$_POST["buscarPorText"],$_POST["ordenarPor"],$noRes);
                    } else {
                        buscarPorTituloOISBN($dbh,$_POST["buscarPor"],$_POST["buscarPorText"],$_POST["ordenarPor"],$noRes);
                    }
                }
            }
        } else {
            todosLosLibros($dbh,"titulo",$noRes);
        }
    } catch (PDOException $e) { 
        echo "<p style='color:#f00;'>Error del servidor.</p>";
    } finally { 
        if (isset($dbh)) { 
            $dbh = null;
            if(!empty($cadError)){
                setcookie("error",$cadError,time() + 5);
                header("Location: paginaAdmin.php");
            }
        } 
    }
?>
        </table>
<?php
    if($noRes == false) {
        echo "<p style='color:#aaa;'>Sin Resultados...</p>";
    }
?>
    </div>
    <div>
        <a href="anyadirLibros.php">Añadir Libro</a> /
        <a href="cerrarSesion.php">Cerrar Sesión</a>
    </div>
    
</div>  
<?php 
    require_once "comunes/footer.html";
?>  
</body>
</html>