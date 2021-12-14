<?php
    if(isset($_GET["x"])){
        if(empty($_GET["x"])){
            $x = 0;
        } else {
            $x = $_GET["x"];
        }
    } else {
        $x = 144;
    }

    if(isset($_GET["y"])){
        if(empty($_GET["y"])){
            $y = 0;
        } else {
            $y = $_GET["y"];
        }
    } else {
        $y = 999;
    }

    echo "x = $x     y = $y."."<br>";
    echo "suma($x+$y): ".$x+$y.".<br>";
    echo "Resta($x-$y): ".$x-$y.".<br>";

    try {
        $div = $x/$y;
        echo "División(($x/$y): ".$div.".<br>";
    } catch(Exception $e) {
        echo 'Se ha producido un error: ' . $e->getMessage();
    }
    
    echo "Multiplicación(($x*$y): ".$x*$y.".<br>";

?>