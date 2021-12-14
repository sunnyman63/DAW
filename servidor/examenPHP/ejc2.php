<?php
    class contacto {
        public static $genCod = 0;
        private $nombre;
        private $numero;
        private $cod;
        private $esProf;
        private $correo;

        public function __construct($numero,$esprof,$nombre) {
            if($nombre!="") {
                $this->nombre = $nombre;
            } else {
                $this->nombre = "Anonimo";
            }
            
            $this->numero = $numero;
            self::$genCod += 1;
            $this->cod = self::$genCod;
            $this->esProf = $esprof;
        }

        public function setCorreo($correo) {
            if($this->esProf==true) {
                $this->correo = $correo;
                //echo "Correo añadido.<br>";
            } else {
                echo "No es un contacto profesional por lo tanto no necesita email.<br>";
            }
        }

        public function getDatos() {
            if($this->esProf==true) {
                return "Cod:".$this->cod." Nombre: ".$this->nombre.", Num: ".$this->numero.", Correo: ".$this->correo."<br>";
            } else {
                return "Cod:".$this->cod." Nombre: ".$this->nombre.", Num: ".$this->numero."<br>";
            }
        }
    }

    $contactos = Array();

    function listarContactos($contactos) {
        foreach($contactos as $contacto) {
            echo $contacto->getDatos();
        }
    }

    echo "Agenda creada.<br>";

    $persona = new contacto("555555555",false,"Antonio");
    array_push($contactos,$persona);
    $persona = new contacto("444444444",false,"Maria");
    array_push($contactos,$persona);
    $persona = new contacto("333333333",false,"Jonas");
    array_push($contactos,$persona);

    echo "Agregados los contactos de Antonio, Maria y  Jonas.<br>";
    
    listarContactos($contactos);

    $persona = new contacto("222222222",true,"profe");
    $persona->setCorreo("elprofe@profesor.es");
    array_push($contactos,$persona);

    $persona = new contacto("111111111",false,"");
    array_push($contactos,$persona);

    echo "Añadidos profe y sin nombre.<br>";

    echo "Buscamos a Jonas:<br>";
    foreach($contactos as $contacto) {
        $datos = $contacto->getDatos();
        if(strpos($datos,"Jonas")) {
            echo $datos;
        }
    }

    echo "Listado de todos los contactos: <br>";

    listarContactos($contactos);

?>