<?php
    require_once("cuentaBancaria.php");
    echo "Numero de cuentas existentes: ".cuentaBancaria::$numCuentas."<br>";
    echo "Creamos 5 cuentas.<br>";
    $c1 = new cuentaBancaria("Alex",0);
    $c1->toString();
    $c2 = new cuentaBancaria("Javi",0);
    $c2->toString();
    $c3 = new cuentaBancaria("Dei",0);
    $c3->toString();
    $c4 = new cuentaBancaria("Rubén",0);
    $c4->toString();
    $c5 = new cuentaBancaria("David",0);
    $c5->toString();
    echo "Numero de cuentas existentes: ".cuentaBancaria::$numCuentas."<br>";
    echo "Borramos tres cuentas.<br>";
    unset($c1);
    unset($c2);
    unset($c3);
    echo "Numero de cuentas existentes: ".cuentaBancaria::$numCuentas."<br>";
    echo "Creamos una cuenta más.<br>";
    $c6 = new cuentaBancaria("Adrián",0);
    $c6->toString();
    echo "Numero de cuentas existentes: ".cuentaBancaria::$numCuentas."<br>";

?>