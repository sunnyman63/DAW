<?php

namespace App\Service;

class proveedor {

    private $array = [];

    public function generador($a, $b) {
        for($i=0;$i<$a;$i++) {
            $numRand = random_int(0,$b);
            array_push($this->array,$numRand);
        }
        return $this->array;
    }

}