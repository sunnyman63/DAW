<?php

class evento {

    private $nombre;
    private $fechaHora;
    private $tipo;
    private $urgencia;
    private $localizacion;

    public function __construct($nom="",$fechaHora="",$tipo="",$urgencia=10,$ubi="") {
        $this->nombre = $nom;
        $this->fechaHora = $fechaHora;
        $this->tipo = $tipo;
        $this->urgencia = $urgencia;
        $this->localizacion = $ubi;
    }

    //Getters y Setters

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }

    public function __toString(){
        $resp = $this->id.": ".$this->nombre." el día ".$this->fechaHora->format("d/m/y").
        " a las ".$this->fechaHora->format("H:i:s");

        if($this->tipo == "social") {
            $resp .= " en ".$this->localizacion;
        }

        if($this->tipo == "urgente") {
            $resp .= " prioridad ".$this->urgencia;
        }

        return $resp."<br>";
    }

}