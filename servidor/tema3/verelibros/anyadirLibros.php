<?php
    session_start();
    $cadError = "";
    $cadExito = "";
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

    if(isset($_POST["submit"])) {
        try { 
            $dbh = new PDO($cadenaConexion, $usuario, $clave, $options);
            class Libro {
                public $titulo;
                public $isbn;
                public $fecha;
                public $precio;
                public $almacenados;
        
                public function __construct($titulo,$isbn,$fecha,$precio,$almacenados){
                    $this->titulo = $titulo;
                    $this->isbn = $isbn;
                    $this->fecha = $fecha;
                    $this->precio = $precio;
                    $this->almacenados = $almacenados;
                }
            }

            $cliente = new Libro($_POST["titulo"],$_POST["isbn"],$_POST["fecha"],$_POST["precio"],$_POST["almacenados"]);
            //PREPARE -> BIND -> EXECUTE 
            //Prepare 
            $stmt = $dbh->prepare("insert into libro(titulo, isbn, anyo_publicacion, precio, almacenados) values(:titulo, :isbn, :fecha, :precio, :almacenados)"); 
            //Execute
            if ($stmt->execute((array)$cliente)) { 
                $stmt = $dbh->prepare("SELECT id FROM autor WHERE nombre=:nombre");
                $stmt->bindParam(":nombre",$_POST["autor"]);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();
                $autor = "";
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $autor = $row["id"];
                }
                if(empty($autor)) {
                    $stmt = $dbh->prepare("INSERT INTO autor(nombre) VALUES (:nombre)");
                    $stmt->bindParam(":nombre",$_POST["autor"]);
                    $stmt->execute();
                    $stmt = $dbh->prepare("SELECT id FROM autor WHERE nombre=:nombre");
                    $stmt->bindParam(":nombre",$_POST["autor"]);
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $stmt = $dbh->prepare("INSERT INTO escrito(isbn, idAutor) VALUES(:isbn, :idAutor)");
                        $stmt->bindParam(":isbn",$_POST["isbn"]);
                        $stmt->bindParam(":idAutor",$row["id"]);
                        $stmt->execute();
                    }
                } else {
                    $stmt = $dbh->prepare("INSERT INTO escrito(isbn, idAutor) VALUES(:isbn, :idAutor)");
                    $stmt->bindParam(":isbn",$_POST["isbn"]);
                    $stmt->bindParam(":idAutor",$autor);
                    $stmt->execute();
                }
                $cadExito = "Libro creado satisfactoriamente.";      
            }            
        } catch (PDOException $e) { 
            if(strpos($e,"PRIMARY")!=-1) {
                $cadError = "Ya existe un libro con ese ISBN";
                //$cadError = $e;
            } else {
                $cadError = "Error del servidor";
            }
        } finally { 
            if (isset($dbh)) { 
                $dbh = null;
            } 
        }
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
    if(!empty($cadError)) {
        echo "*".$cadError;
    }
    if(!empty($cadExito)) {
        echo "<p style='color: #aaa;'>".$cadExito."</p>";
    }
?>
    </div>
    <form action="anyadirLibros.php" method="POST" autocomplete="off">
        <label>Titulo: </label><br><input type="text" name="titulo" required><br>
        <label>Autor:</label><br><input type="text" name="autor" required><br>
        <label>ISBN:</label><br><input type="text" name="isbn" required><br>
        <label>Fecha de Publicación:</label><br><input type="text" name="fecha" required><br>
        <label>Precio:</label><br><input type="text" name="precio" required><br>
        <label>Cantidad Almacenada:</label><br><input type="text" name="almacenados" required><br>
        <input type="submit" name="submit" value="Añadir">
    </form>
    <div>
        <a href="paginaAdmin.php">Volver al listado</a> /
        <a href="cerrarSesion.php">Cerrar Sesión</a>
    </div>
    
</div>  
<?php 
    require_once "comunes/footer.html";
?>  
</body>
</html>