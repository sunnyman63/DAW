<?php

    function calcIVA($valor,$impuesto = 18) {
        if($impuesto == 0) {
            echo "El valor de $valor no incrementa al aplicarle un IVA del $impuesto%.<br>";
        } else {
            $subida = $valor+(($valor*$impuesto)/100);
            echo "El valor de $valor incrementa a $subida al aplicarle un IVA del $impuesto%.<br>";
        }
    }

    calcIVA(1000);
    calcIVA(1000,8);
    calcIVA(10,0);
?>