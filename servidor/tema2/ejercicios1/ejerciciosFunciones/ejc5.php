<?php
    function sumar($n1,$n2,&$resp){
        $resp = $n1 + $n2;
    }

    $variable1 = 10;
    $variable2 = 20;
    $variable3 = 100;

    echo "Variable 1 = ".$variable1."<br>Variable 2 = ".$variable2."<br>Variable 3 = ".$variable3."<br>";
    echo "Hacemos la suma.<br>";
    sumar($variable1,$variable2,$variable3);
    echo "Variable 1 = ".$variable1."<br>Variable 2 = ".$variable2."<br>Variable 3 = ".$variable3."<br>";


?>