<?php

    class empleado {
        protected $nombre;
        protected $apellidos;
        protected $edad;

        public function __construct($nom,$apes,$ed) {
            $this->nombre = $nom;
            $this->apellidos = $apes;
            $this->edad = $ed;
        }
    
        public function __get($indicador) {
            return $this->$indicador;
        }
    
        public function __set($indicador,$valor) {
            $this->$indicador = $valor;
        }
    }
?>