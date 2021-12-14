<?php
    class agenda {

        private $contactos;

        public function __construct() {
            $this->contactos = Array();
        }

        public function anyadirContacto($contacto) {
            array_push($this->contactos,$contacto);
        }

        public function mostrarAgenda() {
            foreach($this->contactos as $contacto) {
                    echo $contacto."<br>";
            }
        }

        public function buscarPorNombreContacto($nombre) {
            foreach($this->contactos as $contacto) {
                if($contacto->nombre == $nombre) {
                    echo $contacto."<br>";
                }
            }
        }

        public function numeroContactos() {
            $count = count($this->contactos);
            if($count == 0) {
                echo "No hay contactos en la Agenda.<br>";
            } else {
                echo "Hay $count contactos en la agenda.<br>";
            }
        }

    }
?>