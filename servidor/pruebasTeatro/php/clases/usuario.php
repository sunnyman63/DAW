<?php

class usuario {

    private $dni;
    private $nombre;
    private $mail;
    private $es_admin;
    private $password;

    public function __construct($d="",$n="",$m="",$a=0,$p="") {
        $this->dni = $d;
        $this->nombre = $n;
        $this->mail = $m;
        $this->es_admin = $a;
        $this->password = $p;
    }

    public function existeUsuario($bd, $dni) {
        $sql = "Select * from USUARIO Where dni=?";
        $datos = Array($dni);
        $resp = $bd->prepararSelectArrays($sql,$datos);
        return $resp;
    }

    public function register($bd) {
        $query = "INSERT INTO USUARIO VALUES (?,?,?,?,?)";
        $datos = [
            $this->dni,
            $this->nombre,
            $this->mail,
            $this->es_admin,
            password_hash($this->password,PASSWORD_BCRYPT,["cost" => 13])
        ];

        if(empty($this->existeUsuario($bd, $this->dni))) {
            $bd->prepararInsercion($query,$datos);
            return "insertado";
        } else {
            return null;
        }
    }

    public function login($dni, $pass, $bd) {
        $user = $this->existeUsuario($bd,$dni);
        if(empty($user)) {
            return null;
        } else {
            if(password_verify($pass,$user[0][4])) {
                return $user[0];
            } else {
                return null;
            }
        }
    }

    //Getters y Setters
    public function __set($variable,$valor) {
        $this->$variable = $valor;
    }

    public function __get($variable) {
        return $this->$variable;
    }

}