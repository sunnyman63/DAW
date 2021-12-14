<?php

    $fichero = file("sopadeletras.txt");
    $dimensiones = [];
    $sopa = [];
    $palabras = [];

    function crearSopa($fichero,&$dimensiones,&$sopa,&$palabras) {

        $dimensiones = explode(",",$fichero[0]);
        for($i=0;$i<$dimensiones[0];$i++) {
            $sopa[$i] = explode(",",$fichero[$i+1]);
        }
        for($x=0;$x<count($fichero)-($dimensiones[0]+1);$x++) {
            $palabras[$x] = trim($fichero[$dimensiones[0]+1+$x],"\n");
        }
    }

    function mostrarSopa($dimensiones,$sopa,$palabras) {
        echo "<table style='border:2px black solid;'>";
        echo "<tr>";
        $letras = [" ","0","1","2","3","4","5","6"];
        for($y=0;$y<$dimensiones[1]+1;$y++){
            echo "<td style='width:20px;text-align:center;'><b>".$letras[$y]."</b></td>";
        }
        echo "</tr>";
        for($x=0;$x<$dimensiones[0];$x++){
            echo "<tr>";
            echo "<td style='width:15px;text-align:center;'><b>".$x."</b></td>";
            for($i=0;$i<$dimensiones[1];$i++) {
                echo "<td style='border:1px black solid;width:20px;text-align:center;'>".$sopa[$x][$i]."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        echo "<br>Palabras a buscar: ".implode(", ",$palabras);
    }

    function buscarEnSopa($sopa,$palabra) {
        $p = strtolower($palabra);
        $IzDe = "";
        $DeIz = "";
        $ArrAbj = "";
        $AbjArr = "";
        $DiagonalIzDe = "";
        $DiagonalDeIz = "";
        $DiagonalDeIzReves = "";
        $DiagonalIzDeReves = "";

        //Para sacar de Izq a Derch y viceversa
        foreach ($sopa as $linea) {
            $IzDe .= trim(implode("",$linea),"\n");
        }
        $DeIz = strrev($IzDe);

        //Para sacar de arriba abajo y viceversa
        for($i=0;$i<count($sopa[0]);$i++) {
            for($x=0;$x<=count($sopa);$x++){
                $ArrAbj .= trim($sopa[$x][$i],"\n");
            }  
        }
        $AbjArr = strrev($ArrAbj);

        //Para sacar la diagonal de Izq a Derch y el reverso
        for($i=0;$i<count($sopa);$i++) {
            for($x=0;$x<=count($sopa);$x++){
                $DiagonalIzDe .= trim($sopa[$i-$x][$x],"\n");
            }
        }
        for($j=count($sopa[0])-1;$j>0;$j--){
            for($y=0;$y<$j;$y++){
                $DiagonalIzDe .= trim($sopa[count($sopa)-1-$y][count($sopa[0])-($j-$y)],"\n");
            }
        }
        $DiagonalIzDeReves = strrev($DiagonalIzDe);

        //Para sacar la diagonal de Derch a Izq y reverso
        for($i=0;$i<count($sopa);$i++) {
            for($x=0;$x<=$i;$x++){
                $DiagonalDeIz .= trim($sopa[count($sopa)-1-$i+$x][$x],"\n");
            }
        }
        for($j=count($sopa[0])-1;$j>0;$j--){
            for($y=0;$y<$j;$y++){
                $DiagonalDeIz .= trim($sopa[($j+$y)-$j][count($sopa[0])-$j+$y],"\n");
            }
        }
        $DiagonalDeIzReves = strrev($DiagonalDeIz);

        //Comprobamos donde esta la palabra
        $arry = [$IzDe,$DeIz,$ArrAbj,$AbjArr,$DiagonalIzDe,$DiagonalIzDeReves,$DiagonalDeIz,$DiagonalDeIzReves];

        for($i=0;$i<count($arry);$i++){
            if(strpos($arry[$i],$p)>0){
                switch($i){
                    case 0:
                        echo "<br>La palabra $p está de Izquierda a Derecha en la sopa de letras.";
                        break;
                    case 1:
                        echo "<br>La palabra $p está de Derecha a Izquierda en la sopa de letras.";
                        break;
                    case 2:
                        echo "<br>La palabra $p está de Arriba a Abajo en la sopa de letras.";
                        break;
                    case 3:
                        echo "<br>La palabra $p está de Abajo a Arriba en la sopa de letras.";
                        break;
                    case 4:
                        echo "<br>La palabra $p está en la diagonal de Arriba a Abajo\n y de Derecha a Izquierda en la sopa de letras";
                        break;
                    case 5:
                        echo "<br>La palabra $p está en la diagonal de Abajo a Arriba\n y de Izquierda a Derecha en la sopa de letras";
                        break;
                    case 6:
                        echo "<br>La palabra $p está en la diagonal de Arriba a Abajo\n y de Izquierda a Derecha en la sopa de letras";
                        break;
                    case 7:
                        echo "<br>La palabra $p está en la diagonal de Abajo a Arriba\n y de Derecha a Izquierda en la sopa de letras";
                        break;
                }
            }
        }


    }

    echo "<h1>Sopa de letras:</h1>";
    crearSopa($fichero,$dimensiones,$sopa,$palabras);
    mostrarSopa($dimensiones,$sopa,$palabras);
    buscarEnSopa($sopa,$palabras[0]);
    buscarEnSopa($sopa,$palabras[1]);
    buscarEnSopa($sopa,$palabras[2]);
    buscarEnSopa($sopa,$palabras[3]);
?>