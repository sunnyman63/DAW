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
                            $this->partidos[$i][$j] = array('local'=>$arry[$aux-1], 'visitante'=>$arry[$nEquipos-1]);
                        } else {
                            $this->partidos[$i][$j] = array('local'=>$arry[$nEquipos-1], 'visitante'=>$arry[$aux-1]);
                        }
                    } else {
                        $this->partidos[$i][$j] = $arry[$aux-1];
                    }
                    if($aux == $nSemanas) {
                        $aux = 1;
                    } else {
                        $aux++;
                    }
                }
            }

            $aux = $nSemanas;

            for($i=0;$i < $nSemanas;$i++) {
                for($j=1;$j<$partidosPorSemana;$j++) {
                    $this->partidos[$i][$j] = array('local'=>$this->partidos[$i][$j], 'visitante'=>$arry[$aux-1]);
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