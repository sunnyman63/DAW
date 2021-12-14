<?php

    function fechaCorrecta($fecha){
        $fechaCumple = new DateTime($fecha);
        $fechaHoy = new DateTime();
        $dif = $fechaCumple->diff($fechaHoy);
        $anyo = $dif->format("%y");
        if($anyo>=18 && $anyo<=70){
            return " tiene $anyo años.";
        } else {
            return false;
        }
    }
    
    
    

    if(isset($_POST["miNombre"])){
        if(empty($_POST["miNombre"])) {
            $mensaje .= "Falta rellenar Nombre 1<br>";
        }else {
            $miNombre = $_POST["miNombre"];
        }

        if(empty($_POST["tuNombre"])) {
            $mensaje .= "Falta rellenar Nombre 2<br>";
        }else {
            $tuNombre = $_POST["tuNombre"];
        }

        if(empty($_POST["miFnac"])) {
            $mensaje .= "Falta rellenar Fecha 1<br>";
        }else {
            $miFnac = $_POST["miFnac"];
            $res = fechaCorrecta($miFnac);
            if($res == false) {
                $mensaje .= "Fecha 1 incorrecta";
            } else {
                $resultado .=$miNombre.$res."<br>";
            }
        }

        if(empty($_POST["tuFnac"])) {
            $mensaje .= "Falta rellenar Fecha 2<br>";
        }else {
            $tuFnac = $_POST["tuFnac"];
            $res = fechaCorrecta($tuFnac);
            if($res == false) {
                $mensaje .= "Fecha 2 incorrecta";
            } else {
                $resultado .=$tuNombre.$res."<br>";
            }
        }
    }
    

?>