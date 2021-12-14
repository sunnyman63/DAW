<?php
    function randomColorHexa(){
        $hexColor = "#";
        for($i = 0 ; $i < 6 ; $i++){
            $num = rand(0, 15);
            switch ($num) {
                case 10: $num = "A"; break;
                case 11: $num = "B"; break;
                case 12: $num = "C"; break;
                case 13: $num = "D"; break;
                case 14: $num = "E"; break;
                case 15: $num = "F"; break; 
            }
            $hexColor .= $num;
        }
        return $hexColor;
    }

    echo "<style>body{bacground-color:".randomColorHexa().";}</style>";
?>