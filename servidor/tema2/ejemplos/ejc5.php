<?php
    $nota1 = 5;
    $nota2 = 8;
    $nota3 = 7;

    if ($nota1 == $nota2 && $nota1 == $nota3){
        echo "Las notas son iguales.";
    }elseif ($nota1 < $nota2 && $nota3 < $nota2){
        echo "La segunda nota es la mayor de las tres notas.";
    }elseif ($nota1 < $nota3){
        echo "La tercera nota es la mayor de las tres notas.";
    }else{
        echo "La primera nota es la mayor de las tres notas.";
    }
?>
