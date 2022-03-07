<?php

require_once "evento.php";
require_once "social.php";
require_once "urgente.php";

class calendario {

    private $nombre;
    private $eventos;

    public function __construct($nom) {
        $this->nombre = $nom;
        $this->eventos = [];
    }

    //Getters y Setters

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }

    //Funciones del calendario

    public function agregarEvento($evento) {
        array_push($this->eventos,$evento);
    }


    public function agregarEventoRecurrente($evento,$numVeces,$intervalo) {
        $fecha = $evento->fechaHora;
        $inter = new DateInterval("P".$intervalo."D");
        $period = new DatePeriod($fecha,$inter,$numVeces-1);

        foreach($period as $newFech) {
            if($newFech == $fecha) {
                array_push($this->eventos,$evento);
            } else {
                $newEv = [];
                if($evento->urgencia) {
                    $newEv = new urgente($evento->nombre,$newFech,$evento->urgencia);
                } 
                if($evento->localizacion) {
                    $newEv = new social($evento->nombre,$newFech,$evento->localizacion);
                } 
                array_push($this->eventos,$newEv);   
            }
        }
          
    }

    public function obtenerEvento($id) {
        $resp = [];
        foreach($this->eventos as $evento) {
            if($evento->id == $id) {
                $resp = $evento;
                break;
            }
        }
        return $resp;
    }

    public function eliminarEvento($id) {
        $resp = [];
        foreach($this->eventos as $evento) {
            if($evento->id == $id) {
                $aux = array_search($evento,$this->eventos);
                array_splice($this->eventos,$aux);
                break;
            }
        }
    }

    public function __toString(){
        $resp = "<b>Calendario: ".$this->nombre."</b><br>";
        foreach($this->eventos as $evento) {
            $resp .= $evento;  
        }
        return $resp."<br>";
    }

}

?>