<?php 

require_once "evento.php";

class urgente extends evento {

    private $urgencia;

    public function __construct($nom,$fechaHora,$urgencia) {
        parent::__construct($nom,$fechaHora);
        $this->urgencia = $urgencia;
    }

    //Getters y Setters

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }

    public function __toString(){
        $resp = parent::__toString()." prioridad ".$this->urgencia;
        return $resp."<br>";
    }

}