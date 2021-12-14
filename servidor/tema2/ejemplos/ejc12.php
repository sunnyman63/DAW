<?php
    $radio = 2;
    define('PI',3.1416);
    $area = PI * pow($radio,2);
    $textoResultado = "El área calculada del círculo es ".number_format($area,2);
    $textoResultadoMayus = strtoupper($textoResultado);
    $textoResultadoModificado = str_replace("calculada","obtenida",$textoResultado);
    $numeros = "1,2,3,4,5";
    $numeros = explode(",",$numeros);
    echo $textoResultado."<br>";
    echo $textoResultadoMayus."<br>";
    echo $textoResultadoModificado."<br>";

    echo "La longitud de esta ultima frase es ".strlen($textoResultadoModificado)."<br>";
    echo "La palabra circulo de la última frase esta en la posición ".strpos($textoResultadoModificado,"círculo");
    echo "<br>";

    for($a = 0;$a < count($numeros);$a++){
        echo $numeros[$a];
        if($a+1!=count($numeros))  {
            echo "+";
        }
    }

    echo "=".array_reduce($numeros,function($carry, $item)
    {
        $carry += $item;
        return $carry;
    },0);
?>