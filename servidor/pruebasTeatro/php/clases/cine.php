<?php

class cine {

    private $cod_cine;
    private $nombre;
    private $direccion;
    private $precio;

    public function __construct($cod_cine="",$nombre="",$direccion="",$precio="") {
        $this->cod_cine = $cod_cine;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->precio = $precio;
    }


    public static function obtenerCine($bd,$cod) {
        $query = "SELECT * FROM CINE WHERE cod_dine = ?";
        $datos = array($cod);
        $resp = $bd->prepararSelectArrays($query,$datos);
        return $resp;
    }

    public static function todosLosCines($bd) {
        $query = "SELECT * FROM CINE";
        $datos = array();
        $resp = $bd->prepararSelectArrays($query,$datos);
        return $resp;
    }

    public static function listarPelisPorCine($bd,$cine) {
        $query = "select DISTINCT PELICULA.cod_peli,PELICULA.titulo 
                  from CINE 
                  inner join PROYECCION on CINE.cod_cine=PROYECCION.cod_cine 
                  inner join PELICULA on PELICULA.cod_peli=PROYECCION.cod_peli 
                  where CINE.cod_cine like ?";
        $datos = array($cine);
        $resp = $bd->prepararSelectArrays($query,$datos);
        return $resp;
    }



}