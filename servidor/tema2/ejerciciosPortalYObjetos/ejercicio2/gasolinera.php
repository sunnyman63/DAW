<?php

    class gasolinera {
        private $direccion;
        private $encargado;
        private $becarios = [];
        private $dineroEnCaja;
        private $surtidores = [];

        public function __construct($direc,$din) {
            $this->direccion = $direc;
            $this->dineroEnCaja = $din;
        }

        public function __get($indicador) {
            return $this->$indicador;
        }

        public function __set($indicador,$valor) {
            switch($indicador){
                case "direccion": $this->direccion = $valor;break;
                case "encargado": $this->encargado = $valor;break;
                case "becarios": array_push($this->becarios,$valor);break;
                case "dineroEnCaja": $this->dineroEnCaja = $valor;break;
                case "surtidores": array_push($this->surtidores,$valor);break;
            }
        }

        public function contratarEncargado($nombre,$apellidos,$edad,$salario) {
            if(empty($this->encargado)){
                $this->encargado = new encargado($nombre,$apellidos,$edad,$salario);
            } else {
                echo "Esta gasolinera ya tiene un encargado";
            }
        }

        public function mostrar(){
            echo "<pre>";
            print_r($this);
            echo "</pre><br>";
        }

        public function comprarCombustible($surtidor,$tipo,$cantidad,$caja){
            $dato = $this->surtidores[$surtidor-1]->comprarCombustible($tipo,$cantidad,$caja);
            if(intval($dato)==0){
                echo $dato;
            }else{
                $this->dineroEnCaja = $dato;
            }
        }

        public function venderCombustible($surtidor,$tipo,$cantidad,$caja) {
            $dato = $this->surtidores[$surtidor-1]->venderCombustible($tipo,$cantidad,$caja);
            if(intval($dato)==0){
                echo $dato;
            }else{
                $this->dineroEnCaja = $dato;
            }
        }

        public function pagarTrabajadores(){
            $this->dineroEnCaja -= $this->encargado->salario;
            $nBecarios = count($this->becarios);
            for($i = 0; $i < $nBecarios; $i ++) {
                $this->dineroEnCaja -= becario::$salario;
            }
        }
    }

?>