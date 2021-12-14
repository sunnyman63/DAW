<?php
    function triangulo($lado1,$lado2,$lado3){
        if($lado1==$lado2 && $lado2==$lado3){
            echo "Es un triangulo equilatero.";
        }else if($lado1==$lado2 || $lado2==$lado3 || $lado1==$lado3){
                echo "Es un triangulo isosceles.";
        }else{
            echo "Es un triangulo escaleno.";
        }
    }

    triangulo(3,3,3);
?>