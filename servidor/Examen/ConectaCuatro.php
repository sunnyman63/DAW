<?php

    class ConectaCuatro {

        private $tablero;

        public function __construct() {
            for($i=0;$i<6;$i++){
                for($j=0;$j<7;$j++){
                    $tablero[$i][$j] = "O";
                }
            }
        }

        public function __toString(){
            return $this->tablero;
        }

        public function mueveMaquina(){
            $randCol = random_int(0,6);
            for($i=5;$i>0;$i--){
                if($this->tablero[$i][$randCol]=="O"){
                    $this->tablero[$i][$randCol] = "M";
                }
            }
        }

        public function mueveJugador(){
            $randCol = random_int(0,6);
            for($i=5;$i>0;$i--){
                if($this->tablero[$i][$randCol]=="O"){
                    $this->tablero[$i][$randCol] = "J";
                }
            }
        }

        public function finalPartida($ente) {
            $resultado = "";
            switch($ente){
                case "Jugador": $ficha = "J"; break;
                case "Maquina": $ficha = "M"; break;
            }
            for($i=0;$i<7;$i++){
                for($j=0;$j<6;$j++) {
                    if($this->tablero[$i][$j]==$ficha){
                        self::buscar($i,$j,$this->tablero,1,0,$ficha,$resultado);
                        self::buscar($i,$j,$this->tablero,-1,0,$ficha,$resultado);
                        self::buscar($i,$j,$this->tablero,0,1,$ficha,$resultado);
                        self::buscar($i,$j,$this->tablero,0,-1,$ficha,$resultado);
                        self::buscar($i,$j,$this->tablero,1,1,$ficha,$resultado);
                        self::buscar($i,$j,$this->tablero,1,-1,$ficha,$resultado);
                        self::buscar($i,$j,$this->tablero,-1,1,$ficha,$resultado);
                        self::buscar($i,$j,$this->tablero,-1,1,$ficha,$resultado);
                    }
                }
            }
            
        }

        public static function buscar($i,$j,$tablero,$horizontal,$vertical,$ficha,&$result){
            $cuatroEn=$tablero[$i][$j];
            for($x=0;$x<4;$x++){
                $i += $vertical;
                $j += $horizontal;
                if(isset($tablero[$i][$j])){
                $cuatroEn.=$tablero[$i][$j];
                }else break;
            }
            if(strcmp($cuatroEn,$ficha.$ficha.$ficha.$ficha)==0) {
                $result = true;
            }
        }
    }

?>