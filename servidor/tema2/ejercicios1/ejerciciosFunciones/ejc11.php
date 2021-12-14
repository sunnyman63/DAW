<?php
    $login =$_GET["u"];
    $alumnos = file("alumnos.txt");

    function iniciarSesion($alums,$log) {
        $logueado = false;
        $curso;

        foreach($alums as $alu) {
            $alu = substr($alu,0,strpos($alu," "));
            if($log==$alu) {
                $logueado = true;
                $curso = substr($alu,strpos($alu," "));
                break;
            }
        }

        if($logueado==true){
            echo "El alumno $login está matriculado en el curso $curso";
        }else{
            echo "El alumno $login no esta matriculado.";
        }
    }

    if(isset($_GET["u"])){
        if(empty($_GET["u"])){
            echo "Debe darle un valor a la variable 'u' en la URL<br>(Ejemplo: '/ejc11.php?u=aromerop1')";
        } else {
            iniciarSesion($alumnos,$login);
        }
    } else {
        echo "Debe insertar ?u= con un valor en la URL<br>(Ejemplo: '/ejc11.php?u=aromerop1')";
    }
?>