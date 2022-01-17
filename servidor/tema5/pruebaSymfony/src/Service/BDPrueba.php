<?php
    namespace App\Service;
    class BDPrueba
    {
        private $contactos = [
            [
                "nombre"=>"Javi",
                "apellido"=>"Prima",
                "edad"=>22
            ],
            [   "nombre"=>"Deivyth",
                "apellido"=>"Sarchi",
                "edad"=>21
            ],
            [   "nombre"=>"Alex",
                "apellido"=>"Romero",
                "edad"=>21
            ]
        ];
        public function get(){
            return $this->contactos;
        }
    }
?>