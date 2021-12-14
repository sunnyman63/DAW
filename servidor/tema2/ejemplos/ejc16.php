<?php
    $tablas = array();

    for($a=1;$a<=15;$a++){
        for($b=0;$b<=10;$b++){
            $tablas[$a][$b] = $b*$a;
        }
    }
    //echo print_r($tablas);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>tablas de multiplicar</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <table border="1px black solid">
            <?php 
                for($a=1;$a<=15;$a++){
                    echo "<tr>";
                    for($b=0;$b<=10;$b++){
                        echo "<td style='width:60px;heigth:30px;text-align:center'>".$tablas[$a][$b]."</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </table>
        <p>
        <?php 
            for($a=1;$a<=15;$a++){
                echo "<b>Tabla del ".$a.":</b><br>";
                for($b=0;$b<=10;$b++){
                    echo $a." x ".$b." = ".$tablas[$a][$b]."<br>";
                }
                echo "<br>";
            }
        ?>
        </p>
    </body>
</html>

