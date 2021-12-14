<?php
    $factorial;
    $sumaFactorials = 0;
    if(isset($_GET["n"])){
        if(empty($_GET["n"])){
            echo "Debe darle un valor a la variable 'n' en la URL<br>(Ejemplo: 'ejc8.php?n=5')";
        } else {
            
            for($a = $_GET["n"];$a > 0;$a--){
                $n = $a;
                $factorial = 1;
                for($n;$n>0;$n--){                    
                    $factorial = $factorial * $n;
                }
                $sumaFactorials += $factorial;
            }
            echo "La suma de los factoriales desde ".$_GET["n"]." hasta 1 da: ".$sumaFactorials;
        }
    } else {
        echo "Debe insertar ?n= con un valor en la URL<br>(Ejemplo: 'ejc8.php?n=5')";
    }
?>