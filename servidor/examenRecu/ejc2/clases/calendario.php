<?php

require_once "evento.php";

class calendario {

    private $id;
    private $nombre;

    public function __construct($nom="") {
        $this->nombre = $nom;
    }

    //Getters y Setters

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }

    //Funciones del calendario

    public function agregarEvento($bd,$evento) {
        $query = "INSERT INTO evento (nombre,fechaHora,tipo,urgencia,localizacion,id_calendario) VALUES (?,?,?,?,?,?)";
        $datos = array($evento->nombre,
                       $evento->fechaHora,
                       $evento->tipo,
                       $evento->urgencia,
                       $evento->localizacion,
                       $this->id);
        $bd->prepararInsercion($query,$datos);
    }


    public function agregarEventoRecurrente($bd,$evento,$numVeces,$intervalo,$tipo) {
        $fecha = $evento->fechaHora;
        $inter = new DateInterval("P".$intervalo."D");
        $period = new DatePeriod($fecha,$inter,$numVeces-1);

        foreach($period as $newFech) {
            if($newFech == $fecha) {
                self::agregarEvento($bd,$evento,$tipo);
            } else {
                $newEv = [];
                if($tipo == "urgente") {
                    $newEv = new urgente($evento->nombre,$newFech,$evento->urgencia);
                } 
                if($tipo == "social") {
                    $newEv = new social($evento->nombre,$newFech,$evento->localizacion);
                } 
                self::agregarEvento($bd,$newEv,$tipo);  
            }
        }
          
    }

    public static function listarCalendarios($bd) {
        $query = "SELECT calendario.nombre, * FROM evento INNER JOIN evento.id_calendario=calendario.id";
        $datos = [];
        $calendarios = $bd->prepararSelectArrays($query,$datos);
        return $calendarios;
    }

    public function obtenerEvento($bd,$id) {
        $resp = [];
        $query = "SELECT * FROM evento WHERE id=?";
        $datos = array($id);
        $bd->prepararSelectObjetos($query,$datos,new evento());
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
        return $resp."<br>";
    }

}

?>