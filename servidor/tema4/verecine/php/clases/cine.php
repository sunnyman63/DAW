<?php

    class cine {

        private $cod_cine;
        private $nombre;
        private $direccion;
        private $precio;

        public function __construct($cod_cine="",$nombre="",$direccion="",$precio="") {
            $this->cod_cine = $cod_cine;
            $this->nombre = $nombre;
            $this->direccion = $direccion;
            $this->precio = $precio;
        }


        public function obtenerCine($db) {

        }

        public function todosLosCines() {
            
        }

        public function obtDespCine() {

        }
    }

?>