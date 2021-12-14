
<?php

    $fichero = "hola.txt";

    if(!file_exists($fichero)){
        echo "$fichero no existe.";
    } else {
        $buffer = file($fichero);
        print_r($buffer);
        file_put_contents($fichero,"\ncomo\nestas?",FILE_APPEND);
        readfile($fichero);

        if(file_exists("adios.txt")){
            echo "El fichero existe";
        } else {
            echo "El fichero no existe";
        }
    }
?>

