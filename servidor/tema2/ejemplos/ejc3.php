<?php
    $num1 = 3;
    $num2 = 5;
    $num3 = 8;
    $num1 *= 4;
    $a = $num1<=$num2;
    
    echo $num1;
    echo "<br>";
    echo $num1 <= $num2;
    echo "<br>";
    echo $num3 > $num1 and $num3 > $num2;
    echo "<br>";
    echo $num3 > $num1 or $num3 > $num2;
    echo "<br>";
    echo $num1 > $num2 xor $num1 > $num3;
    echo "<br>";
    
    $num3--;
    echo $num3;
    echo "<br>";
    $num3 += $num1;
    echo $num3;
    echo $a;
    echo isset($a);
?>
