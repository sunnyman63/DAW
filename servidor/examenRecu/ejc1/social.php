<?php 

require_once "evento.php";

class social extends evento {

    private $localizacion;

    public function __construct($nom,$fechaHora,$ubi) {
        parent::__construct($nom,$fechaHora);
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
        $resp = parent::__toString()." en ".$this->localizacion;
        return $resp."<br>";
    }

}