<?php

    class surtidor {
        static public $dispensadorNumSerie = 0;
        private $numSerie;
        private $capMaxDiesel;
        private $capMaxGasolina;
        private $cantidadDiesel;
        private $cantidadGasolina;
        private $precioCompraDiesel;
        private $precioCompraGasolina;
        private $precioVentaDiesel;
        private $precioVentaGasolina;

        public function __construct($cantDi,$cantGa,$preComDi,$preComGa,$preVenDi,$preVenGa,$capMaxDi=1000,$capMaxGa=1000) {
            self::$dispensadorNumSerie += 1;
            $this->numSerie = self::$dispensadorNumSerie;
            $this->capMaxDiesel = $capMaxDi;
            $this->capMaxGasolina = $capMaxGa;
            $this->precioCompraDiesel = $preComDi;
            $this->precioCompraGasolina = $preComGa;
            $this->precioVentaDiesel = $preVenDi;
            $this->precioVentaGasolina = $preVenGa;
            if($cantDi <= $this->capMaxDiesel) {
                $this->cantidadDiesel = $cantDi;
            } else {
                $this->cantidadDiesel = $this->capMaxDiesel;
            }
            if($cantGa <= $this->capMaxGasolina) {
                $this->cantidadGasolina = $cantGa;
            } else {
                $this->cantidadDiesel = $this->capMaxGasolina;
            }
        }

        public function __get($indicador) {
            return $this->$indicador;
        }
    
        public function __set($indicador,$valor) {
            $this->$indicador = $valor;
        }

        public function comprarCombustible($tipo,$cantidad,$caja) {
            switch($tipo) {
                case "diesel":
                    $espacio = $this->capMaxDiesel - $this->cantidadDiesel;
                    if($cantidad > $espacio) {
                        return "Solo caben $espacio más en el tanque del Diesel";
                    }else{
                        $this->cantidadDiesel += $cantidad;
                        $precio = $cantidad * $this->precioCompraDiesel;
                        return $caja - $precio;
                    }
                    break;
                case "gasolina":
                    $espacio = $this->capMaxGasolina - $this->cantidadGasolina;
                    if($cantidad > $espacio) {
                        return "Solo caben $espacio más en el tanque de la Gasolina";
                    }else{
                        $this->cantidadGasolina += $cantidad;
                        $precio = $cantidad * $this->precioCompraGasolina;
                        return $caja - $precio;
                    }
                    break;
                case "MAX":
                    $espacioGas = $this->capMaxGasolina - $this->cantidadGasolina;
                    $this->cantidadGasolina += $espacioGas;
                    $precioGas = $espacioGas * $this->precioCompraGasolina;

                    $espacioDi = $this->capMaxDiesel - $this->cantidadDiesel;
                    $this->cantidadDiesel += $espacioDi;
                    $precioDi = $espacioDi * $this->precioCompraDiesel;

                    return $caja - ($precioGas + $precioDi);

            }
        }

        public function venderCombustible($tipo,$cantidad,$caja) {
            switch($tipo) {
                case "diesel":
                    if($cantidad<=$this->cantidadDiesel){
                            $precio = $cantidad * $this->precioVentaDiesel;
                            $this->cantidadDiesel -= $cantidad;
                            return $caja + $precio;
                    }else{
                        if($this->cantidadDiesel == 0) {
                            return "No queda Diesel en el tanque que vender";
                        } else {
                            return "No puedes vender más Diesel del que hay";
                        }
                    }break;
                case "gasolina":
                    if($cantidad<=$this->cantidadGasolina){
                        $precio = $cantidad * $this->precioVentaGasolina;
                        $this->cantidadGasolina -= $cantidad;
                        return $caja + $precio;
                }else{
                    if($this->cantidadGasolina == 0) {
                        return "No queda Gasolina en el tanque que vender";
                    } else {
                        return "No puedes vender más Gasolina del que hay";
                    }
                }break;
            }
        }

        public function mostrar() {
            echo "<pre>";
            print_r($this);
            echo "</pre><br>";
        }
    }
?>