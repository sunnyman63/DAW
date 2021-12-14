<?php

    $arry = [];

    function arrayNumAleatorios(&$arr) {

        for($i = 0;$i<15;$i++){

            $num = 0;

            do {
                $num = random_int(1,50);
            } while(in_array($num,$arr));

            array_push($arr,$num);
        }      
    }

    function mediaAritmetica($arr) {
        $media = (array_sum($arr)/count($arr));
        echo "<br>Media aritmetica: ".$media;
    }
    
    arrayNumAleatorios($arry);
    echo "Array de números: (".implode(",",$arry).").";
    mediaAritmetica($arry);
?>