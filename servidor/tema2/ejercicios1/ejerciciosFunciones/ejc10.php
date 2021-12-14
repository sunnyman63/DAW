<?php

    $nomyApe = file("nombresyApellidos.txt");
    $nombres = explode(";",$nomyApe[0]);
    $apellidos = explode(";",$nomyApe[1]);
    $cursos = ["1ºDAW","1ºASIR","1ºDAM"];
    $alumnos = [];

    //echo $apellidos;

    function creacionAlumnos($noms,$apes,$curs,&$alums) {
        for($i=0;$i<100;$i++){

            $nomAlu = "";
            //Inicial del Nombre
            $num = mt_rand(0,count($noms)-1);
            $nomAlu .= substr($noms[$num],0,1);
            //1er Apellido
            $num = mt_rand(0,count($apes)-1);
            $nomAlu .= htmlspecialchars($apes[$num]);
            //Inicial 2º Apellido
            $num = mt_rand(0,count($apes)-1);
            $nomAlu .= substr(htmlspecialchars($noms[$num]),0,1);
            //Se pasa todo a minusculas
            $nomAlu = strtolower($nomAlu);
            $long = strlen($nomAlu);//Lo que mide el nombre sin añadirle el curso
            //Se le añade el curso
            $num = mt_rand(0,count($curs)-1);
            $nomAlu .= " ".$curs[$num];

            while(in_array($nomAlu,$alums)){//Mientras el nombre este en el array
                //Se le quita el curso
                $nA = substr($nomAlu,0,strpos($nomAlu," "));
                if(intval(substr($nA,strlen($nA)-1)) == 0) {//Si la última posición del nombre no es un número
                    $nA .= "1"; // ej: aromerop1
                    $nA .= " ".$curs[$num];//Se le añade otra vez el curso
                    $nomAlu = $nA;//Se guarda otra vez en nomAlu
                    
                } else { //Si la última posición del nombre es un número
                    $n = intval(substr($nA,strlen($nA)))+1;//Se guarda el número de la última posición +1
                    $nA = substr($nA,1,strlen($nA)-1);//Se le quita el número al nombre
                    $nA .= $n;//Se le pone el nuevo número al final del nombre
                    $nA .= " ".$curs[$num];//Se le añade otra vez el curso
                    $nomAlu = $nA;//Se guarda otra vez en nomAlu
                }
            }
            
            
            array_push($alums,$nomAlu);
        }
    }
    
    function guardarAlumnos($alums) {
        foreach($alums as $alu){
            if($alu==$alums[0]){
                file_put_contents("alumnos.txt",$alu);
            } else {
                file_put_contents("alumnos.txt","\n".$alu,FILE_APPEND);
            }
        }
        echo "<br>Se han guardado todos los nombres en alumnos.txt";
    }

    creacionAlumnos($nombres,$apellidos,$cursos,$alumnos);
    echo "<pre>";
    echo print_r($alumnos);
    echo "</pre>";
    guardarAlumnos($alumnos);
?>