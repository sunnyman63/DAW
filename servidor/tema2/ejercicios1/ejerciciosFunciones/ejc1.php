<?php
    function parImpar($n1){
        if($n1%2==0) {
            echo "El numero ".$n1." es par.";
        } else {
            echo "El numero ".$n1." es impar.";
        }
    };

    if(isset($_GET["n"])){
        if(empty($_GET["n"])){
            echo "Debe darle un valor a la variable 'n' en la URL<br>(Ejemplo: '/ejc1.php?n=5')";
        } else {
            parImpar($_GET["n"]);
        }
    } else {
        echo "Debe insertar ?n= con un valor en la URL<br>(Ejemplo: '/ejc1.php?n=5')";
    }
?>