<?php
    require_once "BaseDatos.php";

    class Usuario {
        private $dni;
        private $nombre;
        private $mail;
        private $es_admin;
        private $password;

        public function __construct($dni="",$password="",$nombre=null,$mail=null,$es_admin=0){
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->mail = $mail;
            $this->es_admin = $es_admin;
            $this->password = $password;
        }
        
        //Comprobar que existe o no el usuario
        public function existeUsuario($db) {
            $sql = "Select dni from USUARIO Where dni=?";
            $datos = Array($this->dni);
            $resp = $db->prepararQuerySelectArrays($sql,$datos);
            return !empty($resp);
        }

        //Inserción de un usuario en la base de datos
        public function insertarUsuario($db) {
            $sql = "INSERT INTO USUARIO VALUES (?, ?, ?, ?, ?)";
            $datos = Array(
                $this->dni,
                $this->nombre,
                $this->mail,
                $this->es_admin,
                password_hash($this->password,PASSWORD_BCRYPT,["cost" => 13])
            );
            if(!$this->existeUsuario($db)) {
                $db->prepararQueryInsercion($sql,$datos);
                echo 0;
            } else {
                echo null;
            }
        }

        //Iniciar sesión con un usuario
        // public function login($db) {
        //     $sql = "SELECT * FROM USUARIO WHERE dni=?";
        //     $datos = Array($this->dni);
        //     if($this->existeUsuario($db)) {
        //         $resp = $db->prepararQuerySelectArrays($sql,$datos);
        //         if(password_verify($this->password,$resp[0][4])) {
        //             $this->es_admin = $resp[0][3];
        //             echo 0;//Todo correcto
        //         } else {
        //             echo 1;//Contraseña incorrecta
        //         }
        //     } else {
        //         echo 2;//Usuario no encontrado
        //     }
        // }

        public static function login2($db,$dni,$pass) {
            $sql = "SELECT * FROM USUARIO WHERE dni=?";
            $datos = [$dni];
            $log = $db->prepararQuerySelectObjetos($sql,$datos,"Usuario");
            if(!empty($log)) {
                if(password_verify($pass,$log[0]->password)) {
                    return $log[0];
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }

        //Getters y Setters
        public function __set($variable,$valor) {
            switch($variable) {
                case "dni": $this->dni = $valor; break;
                case "nombre": $this->nombre = $valor; break;
                case "mail": $this->mail = $valor; break;
                case "es_admin": $this->es_admin = $valor; break;
                case "password": $this->password = $valor; break;
            }
        }

        public function __get($variable) {
            switch($variable) {
                case "dni": return $this->dni; break;
                case "nombre": return $this->nombre; break;
                case "mail": return $this->mail; break;
                case "es_admin": return $this->es_admin; break;
                case "password": return $this->password; break;
            }
        }
    }
?>