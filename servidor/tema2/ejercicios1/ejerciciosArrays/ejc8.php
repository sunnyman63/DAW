<?php
    for($a=0;$a<10;$a++){
        $numeros[$a] = random_int(1,100);
    }
    echo "<pre>";
    print_r($numeros);
    echo "</pre>";

    foreach($numeros as $numero){
        $suma += $numero;
    }
    echo "La suma de todos los números del Array es ".$suma."<br>";
    sort($numeros);
    echo "El número más ALTO del array es ".$numeros[9]."<br>";
    echo "El número mas BAJO del array es ".$numeros[0];
?>