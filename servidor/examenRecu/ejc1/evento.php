<?php

class evento {

    static public $increment = 0;
    protected $id;
    protected $nombre;
    protected $fechaHora;

    public function __construct($nom,$fechaHora) {
        self::$increment += 1;
        $this->id = self::$increment;
        $this->nombre = $nom;
        $this->fechaHora = $fechaHora;
    }

    //Getters y Setters

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }

    public function __toString(){
        return $this->id.": ".$this->nombre." el día ".$this->fechaHora->format("d/m/y").
        " a las ".$this->fechaHora->format("H:i:s");;
    }

}