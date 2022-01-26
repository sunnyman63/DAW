<?php

    namespace App\Service;
    class nombresAleatorios {

        private $sustantivos = [
            "entresijo", "discurso", "bola", "empate",
            "cortina", "firma", "chupete", "biografía",
            "fragmento", "estimulo", "anomalía", "ecuación",
            "comodidad", "disparate", "antepasado", "esperanza",
            "código fuente", "alteración", "economía", "casco"
        ];

        private $adjetivos = [
            "constitucional", "alegre", "insignificante", "fascinante",
            "judicial", "tracicional","fatal", "útil",
            "invisible", "documental", "similar", "individual",
            "menor", "feudal", "sobrenatural", "sindical",
            "forestal", "teatral", "militar", "fiel"
        ];

        public function getPelicula() {
            return $this->sustantivos[random_int(0,count($this->sustantivos))]
                   + " " +
                   $this->adjetivos[random_int(0,count($this->adjetivos))];
        }
    }

?>