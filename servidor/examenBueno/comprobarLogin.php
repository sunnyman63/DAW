<?php
session_start();
function existeUsu($login){
    require("conexionBBDD.php");
    try{
        $dbh = new PDO($dsn, $usuario, $clave, $options);
        $stmt = $dbh->prepare('select dni from USUARIO where nombre=?');

        $stmt->bindParam(1,$login);
        $stmt->setFetchMode(PDO::FETCH_BOUND);
        $stmt->execute();
        $stmt->bindColumn(1,$existe);
        $stmt->fetch();
        if($existe==""){
            return false;
        }else{
            return true;
        }

    } catch (PDOException $e) {
        echo 'Error con la base de datos: ' . $e->getMessage();
    }
}
function obtenerPass($login){
    require("conexionBBDD.php");
    try{
        $dbh = new PDO($dsn, $usuario, $clave, $options);
        $stmt = $dbh->prepare('select password from USUARIO where nombre=?');

        $stmt->bindParam(1,$login);
        $stmt->setFetchMode(PDO::FETCH_BOUND);
        $stmt->execute();
        $stmt->bindColumn(1,$existe);
        $stmt->fetch();
        return $existe;

    } catch (PDOException $e) {
        echo 'Error con la base de datos: ' . $e->getMessage();
    }
}
function obtenerEsDNI($login){
    require("conexionBBDD.php");
    try{
        $dbh = new PDO($dsn, $usuario, $clave, $options);
        $stmt = $dbh->prepare('select dni from USUARIO where nombre=?');

        $stmt->bindParam(1,$login);
        $stmt->setFetchMode(PDO::FETCH_BOUND);
        $stmt->execute();
        $stmt->bindColumn(1,$existe);
        $stmt->fetch();
        return $existe;

    } catch (PDOException $e) {
        echo 'Error con la base de datos: ' . $e->getMessage();
    }
}
function obtenerEsAdmin($login){
    require("conexionBBDD.php");
    try{
        $dbh = new PDO($dsn, $usuario, $clave, $options);
        $stmt = $dbh->prepare('select es_admin from USUARIO where nombre=?');

        $stmt->bindParam(1,$login);
        $stmt->setFetchMode(PDO::FETCH_BOUND);
        $stmt->execute();
        $stmt->bindColumn(1,$existe);
        $stmt->fetch();
        if($existe==true){
            return true;
        }else{
            return false;
        }

    } catch (PDOException $e) {
        echo 'Error con la base de datos: ' . $e->getMessage();
    }
}

function logearse(){
    $nombre=$_POST["nombre"];
    $password=$_POST["pass"];
    $hash=obtenerPass($nombre);
    if (existeUsu($nombre)){
        if(password_verify($password, $hash)){
            if(obtenerEsAdmin($nombre)){
                $_SESSION["admin"]="admin";
                return 1;
                
            }else{
                $_SESSION["login"]=obtenerEsDNI($nombre);
                return 2;
                
            }
        }else{
            return 0;
        }
    }else{
        return 0;
    }

}
echo logearse();

?>