<?php
    class BaseDatos {
        private $conexion;

        public function __construct() {
            try {
                $this->conexion = new PDO(
                    'mysql:dbname=examen;host=127.0.0.1',
                    'root',
                    '',
                    array( 
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" 
                    )
                );
            } catch(Exception) {
                echo "Error del servidor";
            }    
        }

        //Realiza query de inserción.
        public function prepararQueryInsercion($query,$datos) {
            $stmt = $this->conexion->prepare($query);
            try {
                $stmt->execute($datos);
            } catch(Exception) {
                echo "Error del servidor";
            } 
        }

        public function prepararQuerySelectArrays($query,$datos) {
            $stmt = $this->conexion->prepare($query);
            try {
                $stmt->setFetchMode(PDO::FETCH_NUM);
                $stmt->execute($datos);
            } catch(Exception) {
                echo "Error del servidor";
            }
            return $stmt->fetchAll();
        }

        public function prepararQuerySelectObjetos($query,$datos,$tipo) {
            $stmt = $this->conexion->prepare($query);
            try {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $tipo);
                $stmt->execute($datos);
            } catch(Exception) {
                echo "Error del servidor";
            }
            return $stmt->fetchAll();
        }
    }

?>