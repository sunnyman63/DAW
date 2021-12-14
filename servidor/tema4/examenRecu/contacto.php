<?php
    class contacto {

        protected $nombre;
        protected $numero;
        protected $codigo;
        public static $cod = 0;

        public function __construct($numero,$nombre="anónimo") {
            $this->nombre = $nombre;
            $this->numero = $numero;
            $this->codigo = self::$cod;
            self::$cod++;
        }

        public function __get($variable) {
            if($variable == "nombre") {
                return $this->nombre;
            } else if($variable == "numero") {
                return $this->numero;
            } else if($variable == "codigo") {
                return $this->codigo;
            }
        }

        public function __set($variable,$dato) {
            if($variable == "nombre") {
                $this->nombre = $dato;
            } else if($variable == "numero") {
                $this->numero = $dato;
            } else if($variable == "codigo") {
                $this->codigo = $dato;
            }
        }

        public function __toString(){
            return "Nombre: ".$this->nombre.", Número: ".$this->numero;
        }
    }
?>