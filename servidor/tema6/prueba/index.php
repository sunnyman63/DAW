<?php

$arry = array("1","2","3","4","5","6");
$partidos = [[]];

$nEquipos = count($arry);
$nSemanas = $nEquipos-1;
$partidosPorSemana = $nEquipos/2;

$auxNsemanas = 1;

for($i=0;$i < $nSemanas;$i++) {
    for($j=0;$j<$partidosPorSemana;$j++) {
        
        if($j == 0) {
            if($i % 2 == 0){
                $partidos[$i][$j] = array('local'=>$auxNsemanas, 'visitante'=>$nEquipos);
            } else {
                $partidos[$i][$j] = array('local'=>$nEquipos, 'visitante'=>$auxNsemanas);
            }
        } else {
            $partidos[$i][$j] = $auxNsemanas;
        }
        if($auxNsemanas == $nSemanas) {
            $auxNsemanas = 1;
        } else {
            $auxNsemanas++;
        }
    }
}

$auxNsemInv = $nSemanas;

for($i=0;$i < $nSemanas;$i++) {
    for($j=1;$j<$partidosPorSemana;$j++) {
        $partidos[$i][$j] = array('local'=>$partidos[$i][$j], 'visitante'=>$auxNsemInv);
        if($auxNsemInv == 1) {
            $auxNsemInv = $nSemanas;
        } else {
            $auxNsemInv--;
        }
    }
}

echo "<pre>";
print_r($partidos);
echo "</pre>";

for($i=0;$i < $nSemanas;$i++) {
    for($j=0;$j<$partidosPorSemana;$j++) {
        $newVisitante = $partidos[$i][$j]["local"];
        $newLocal = $partidos[$i][$j]["visitante"];

        $partidos[$i][$j]["local"] = $newLocal;
        $partidos[$i][$j]["visitante"] = $newVisitante;
    }
}

// echo "<pre>";
// print_r($partidos);
// echo "</pre>";