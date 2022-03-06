<?php

class conexionBD {

    private $conexion;

    public function __construct() {
        $datosBD = "mysql:host=localhost;dbname=examen";
        $usu = "root";
        $clave = "";
        $opciones = array( 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" 
        );
        try {
            $this->conexion = new PDO($datosBD,$usu,$clave,$opciones);
        } catch(PDOException $e) {
            echo 'Error con la base de datos.';
        }
    }

    public function prepararInsercion($query, $datos) {
        $statement = $this->conexion->prepare($query);
        try {
            $statement->execute($datos);
        }catch(PDOException $e) {
            echo 'Error con la base de datos.';
        }
    }

    public function prepararSelectArrays($query, $datos) {
        $statement = $this->conexion->prepare($query);
        try {
            $statement->setFetchMode(PDO::FETCH_NUM);
            $statement->execute($datos);
        }catch(PDOException $e) {
            echo 'Error con la base de datos.';
        }
        return $statement->fetchAll();
    }

    public function prepararSelectObjetos($query, $datos, $tipo) {
        $statement = $this->conexion->prepare($query);
        try {
            $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $tipo);
            $statement->execute($datos);
        }catch(PDOException $e) {
            echo 'Error con la base de datos.';
        }
        return $statement->fetchAll();
    }

}