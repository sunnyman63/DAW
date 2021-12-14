<?php

    $archivo = file("titulares.txt");
    $rand = random_int(0,count($archivo));
    echo trim($archivo[$rand]);

?>