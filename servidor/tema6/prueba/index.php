<?php

$arry = array("1","2","3","4","5","6");
$partidos = [[]];

$nSemanas = count($arry)-1;
$ntotalpartidos = count($arry) * $nSemanas;
$partidosPorSemana = count($arry)/2;

$aux = [];
$auxNsemanas = 1;
for($i=0;$i < $nSemanas;$i++) {
    for($j=0;$j<$partidosPorSemana;$j++) {
        $partidos[$i][$j] = $auxNsemanas;
        if($auxNsemanas == $nSemanas) {
            $auxNsemanas = 1;
        } else {
            $auxNsemanas++;
        }
    }
}

// foreach($arry as $loc) {
//     foreach($arry as $vis) {
//         if($vis != $loc) {
//             $aux = array('local'=>$loc, 'visitante'=>$vis);
//             array_push($matrix,$aux);
//         }
//     }
// }

// $partidos = array();
// $semana = 1;
// $pos = 0;
// for($i=0;$i<count($arry)*4;$i++) {

// }
// foreach($matrix as $partido) {
//     $partidos["semana$semana"] = array();
//     if($pos==0) {
//         array_push($partidos["semana$semana"], $partido);
//     }
//     $pos++;
//     $semana++;
// }

// echo "<pre>";
// print_r($matrix);
// echo "</pre>";

echo "<pre>";
print_r($partidos);
echo "</pre>";