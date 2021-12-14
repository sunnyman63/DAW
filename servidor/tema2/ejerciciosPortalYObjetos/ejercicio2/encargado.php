<?php
    require_once "empleado.php";

    class encargado extends empleado {

        private $salario;

        public function __construct($nom,$apes,$ed,$sal) {
            $this->nombre = $nom;
            $this->apellidos = $apes;
            $this->edad = $ed;
            if($sal >= 200) {
                $this->salario = $sal;
            } else {
                $this->salario = 200;
            }
        }

        public function __get($indicador) {
            return $this->$indicador;
        }

        public function __set($indicador,$valor) {
            if($indicador == "salario") {
                if($valor<200) {
                    $this->$indicador = 200;
                    echo "El encargado no puede cobrar menos de 200€. Salario cambiado a 200€.";
                }
            }else{
                $this->$indicador = $valor;
            } 
        }

        public function contratarBecarios($nombre,$apellidos,$edad,$estudios){
            return new becario($nombre,$apellidos,$edad,$estudios);
        }

        public function mostrar() {
            echo "<pre>";
            print_r($this);
            echo "</pre><br>";
        }
    }
?>