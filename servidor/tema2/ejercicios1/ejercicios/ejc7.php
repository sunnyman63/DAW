<?php
    if(isset($_GET["alt"])){
        if(empty($_GET["alt"])){
            echo "Debe darle un valor a la variable 'alt' en la URL<br>(Ejemplo: 'ejc7.php?alt=5')";
        } else {
            $alt = $_GET["alt"];
            echo "<pre>";
            for($a=1;$a<=$alt;$a++){
                
                $sp = str_repeat(" ",$alt-$a).str_repeat("*",$a+($a-1));
                
                echo "$sp<br>";
            }
            echo "</pre>";
        }
    } else {
        echo "Debe insertar ?alt= con un valor en la URL<br>(Ejemplo: 'ejc7.php?alt=5')";
    }
?>