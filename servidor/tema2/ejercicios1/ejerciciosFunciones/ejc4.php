<?php
    function calcPotencia($base,$exp = 2){
        $exponente = $base;
        for($a=1;$a<$exp;$a++){
            $exponente *= $base;
        }
        echo $base." elevado a ".$exp." es igual a ".$exponente;
    }

    calcPotencia(5,3);
?>