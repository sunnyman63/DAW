<?php
    function randomColorRGBA() {
        $rgbColor = "";

        for($i=0;$i<3;$i++){
            $rgbColor .= strval(mt_rand(0, 255).",");
        }

        $rgbColor .= strval(1);
        return $rgbColor;
    }

    echo "<style>body{background-color:rgba(".randomColorRGBA().");}</style>";

?>