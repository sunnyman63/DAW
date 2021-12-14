<?php
    require_once "empleado.php";

    class becario extends empleado {

        static public $salario = 5;
        private $estudios;

        public function __construct($nom,$apes,$ed,$est) {
            parent::__construct($nom,$apes,$ed);
            $this->estudios = $est;
        }

        public function __get($indicador) {
            $this->$indicador;
        }

        public function __set($indicador,$valor) {
            $this->$indicador = $valor;
        }

        public function mostrar() {
            echo "<pre>";
            print_r($this);
            echo "</pre><br>";
        }
    }

?>