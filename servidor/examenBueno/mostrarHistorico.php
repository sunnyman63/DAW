<?php

session_start();
    if(!isset($_SESSION["login"])){
        header("Location:login.php");
    }
//Si no hay datos no muestra nada
function mostrar(){
    require("conexionBBDD.php");
    $DNI=$_SESSION["login"];
    try{

        $dbh = new PDO($dsn, $usuario, $clave, $options);
        $stmt = $dbh->prepare("select ENTRADA.dni,PELICULA.titulo,ENTRADA.precio from ENTRADA inner join PELICULA on PELICULA.cod_peli=ENTRADA.cod_peli where ENTRADA.dni=?");
        $stmt->setFetchMode(PDO::FETCH_BOUND);
        $stmt->bindParam(1,$DNI);
        $stmt->execute();
        $stmt->bindColumn(1,$dni);
        $stmt->bindColumn(2,$titulo);
        $stmt->bindColumn(3,$precio);
        while ($row = $stmt->fetch()) {
            echo " DNI: ".$dni." <br>Titulo: ".$titulo."<br> Precio: ".$precio."<br>"."<br>";
        }     

    } catch (PDOException $e) {
            echo 'Error con la base de datos: ' . $e->getMessage();
    }
        
    
    
}
mostrar();




?>
<a href="cerrarSesion.php">Cerrar Sesion</a>