<?php

    class cuentaBancaria {

        static public $numCuentaUnica = 0;
        static public $numCuentas = 0;
        private $titular;
        private $saldo;
        private $cuentaUnica;

        public function __construct($titular,$saldo) {
            self::$numCuentaUnica += 1;
            self::$numCuentas += 1;
            $this->titular = $titular;
            $this->saldo = $saldo;
            $this->cuentaUnica = self::$numCuentaUnica;
        }

        public function __destruct() {
            self::$numCuentas -= 1;
        }

        public function toString() {
            echo "<b>Titular:</b> ".$this->titular
            ."; <b>Saldo:</b> ".$this->saldo
            ."; <b>Numero de cuenta:</b> ".$this->cuentaUnica."<br>";
        }

    }

?>