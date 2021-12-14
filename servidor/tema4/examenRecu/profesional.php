<?php
    require_once "contacto.php";

    class profesional extends contacto {

        private $correo;

        public function __construct($correo,$numero,$nombre) {
            parent::__construct($numero,$nombre);
            $this->correo = $correo;   
        }

        public function __get($variable) {
            if($variable == "nombre") {
                return $this->nombre;
            } else if($variable == "numero") {
                return $this->numero;
            } else if($variable == "codigo") {
                return $this->codigo;
            } else if($variable == "correo") {
                return $this->correo;
            }
        }

        public function __set($variable,$dato) {
            if($variable == "nombre") {
                $this->nombre = $dato;
            } else if($variable == "numero") {
                $this->numero = $dato;
            } else if($variable == "codigo") {
                $this->codigo = $dato;
            } else if($variable == "correo") {
                $this->correo = $dato;
            }
        }

        public function __toString(){
            return parent::__toString().", Correo: ".$this->correo;
        }
    }
?>