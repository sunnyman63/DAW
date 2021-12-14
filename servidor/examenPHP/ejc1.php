<?php

    $fichero = file("palabras.txt");
    $signos = [" ","'",'"',",",".",":","¡","!","¿","?",";"];

    foreach($fichero as $linea) {
        $palabra = trim($linea,"\n");
        $palabrareves = strrev($palabra);
        $palabraformateada = strtolower(str_replace($signos,"",$linea));
        $palabrarevesformateada = strrev($palabraformateada);
        echo "\"$palabra\" y \"$palabrareves\" ";
        if(strncmp($palabraformateada,$palabrarevesformateada,strlen($palabraformateada))) {
            echo "son palíndromos.<br>";
        } else {
            echo "no son palíndromos.<br>";
        }
    }
?>