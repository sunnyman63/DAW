<?php
    $fichero = file("ejer1.txt");
    $frasesSeparadas = [[]];
    $signosInvalidos = ["'","\"",",",".",":","¡","!","¿","?",";"];

    for($i = 0;$i<count($fichero);$i++){
        $fraseAPalabras = explode(" ",trim($fichero[$i],"\n"));
        for($j = 0;$j<count($fraseAPalabras);$j++){
            $palabraALetras = str_split($fraseAPalabras[$j]);
            for($x = 0;$x<count($palabraALetras);$x++) {
                if(in_array($palabraALetras[$x],$signosInvalidos)){
                    array_slice($palabraALetras,$x,$x+1);
                }
            }
            $frasesSeparadas[$i][$j] = implode("",$palabraALetras);
        }
    }

    foreach($frasesSeparadas as $arrayFrase) {
        $contCortas = 0;
        $contMedias = 0;
        $contLargas = 0;
        $contSuperlargas = 0;
        foreach($arrayFrase as $palabra) {
            if(strlen($palabra)<=3) {
                $contCortas += 1;
            }
            if(strlen($palabra)>3 && strlen($palabra)<=6) {
                $contMedias += 1;
            }
            if(strlen($palabra)>6 && strlen($palabra)<=9) {
                $contLargas += 1;
            }
            if(strlen($palabra)>9) {
                $contSuperlargas += 1;
            }
        }
?>
    <p>
        <?=implode(" ",$arrayFrase)?><br>
        Estadísticas:<br>
        Cortas: <?=$contCortas?><br>
        Medias: <?=$contMedias?><br>
        Largas: <?=$contLargas?><br>
        Extralargas: <?=$contSuperlargas?><br>
    </p>
<?php
    }
?>