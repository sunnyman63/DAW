<?php
    $signos = ["'",'"',",",".",":","¡","!","¿","?","(",")",";"," "];
    $fichero = file("palindromos.txt");

    foreach($fichero as $linea) {
        $frase = trim($linea,"\n");
        $frasereves = strrev($frase);
        $fraseformateada = strtolower(str_replace($signos,"",$frase));
        $fraseformateadareves = strrev($fraseformateada);

        if($fraseformateada === $fraseformateadareves) {
            echo "\"$frase\" y \"$frasereves\" son palindromos.<br>";
        } else {
            echo "\"$frase\" y \"$frasereves\" NO son palindromos.<br>";
        }
    }
?>