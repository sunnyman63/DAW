<?php
    function randomColorRGBA() {
        $rgbColor = "";

        //Create a loop.
        for($i=0;$i<3;$i++){
            $rgbColor .= strval(mt_rand(0, 255).",");
        }

        $rgbColor .= strval(1);
        return $rgbColor;
    }

    echo "<style>body{bacground-color:rgba(".randomColorRGBA().");}</style>";

?>