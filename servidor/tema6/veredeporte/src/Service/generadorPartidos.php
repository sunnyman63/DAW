<?php

    namespace App\Service;
    class generadorPartidos {

        private $partidos;

        public function __construct() {
            $this->partidos = [[]];
        }

        public function generarPartidosIda($arry) {

            $nEquipos = count($arry);
            $nSemanas = $nEquipos-1;
            $partidosPorSemana = $nEquipos/2;

            $aux = 1;

            for($i=0;$i < $nSemanas;$i++) {
                for($j=0;$j<$partidosPorSemana;$j++) {
                    if($j == 0) {
                        if($i % 2 == 0){
                            $this->partidos[$i][$j] = array('local'=>$aux, 'visitante'=>$nEquipos);
                        } else {
                            $this->partidos[$i][$j] = array('local'=>$nEquipos, 'visitante'=>$aux);
                        }
                    } else {
                        $this->partidos[$i][$j] = $aux;
                    }
                    if($aux == $nSemanas) {
                        $auxNsemanas = 1;
                    } else {
                        $aux++;
                    }
                }
            }

            $aux = $nSemanas;

            for($i=0;$i < $nSemanas;$i++) {
                for($j=1;$j<$partidosPorSemana;$j++) {
                    $this->partidos[$i][$j] = array('local'=>$this->partidos[$i][$j], 'visitante'=>$aux);
                    if($aux == 1) {
                        $aux = $nSemanas;
                    } else {
                        $aux--;
                    }
                }
            }

            return $this->partidos;
        }

        public function generarPartidosVuelta($arryPartidos) {

            $arry = $arryPartidos;
            $nSemanas = count($arry);
            $partidosPorSemana = count($arry[0]);

            for($i=0;$i < $nSemanas;$i++) {
                for($j=0;$j<$partidosPorSemana;$j++) {

                    $newVisitante = $arry[$i][$j]["local"];
                    $newLocal = $arry[$i][$j]["visitante"];
            
                    $arry[$i][$j]["local"] = $newLocal;
                    $arry[$i][$j]["visitante"] = $newVisitante;
                }
            }

            return $arry;
        }

    }

?>