<?php

    require_once "gasolinera.php";
    require_once "surtidor.php";
    require_once "empleado.php";
    require_once "becario.php";
    require_once "encargado.php";

    echo "<b>Creamos la gasolinera:</b><br>";
    $verepedrol = new gasolinera("Aprobado lejano nº5",7000);
    $verepedrol->mostrar();

    echo "<b>Creamos y añadimos dos surtidores:</b><br>";
    $surtidor1 = new surtidor(700,750,0.5,0.7,1.2,1.35);
    $surtidor2 = new surtidor(250,900,0.5,0.7,1.2,1.35);
    $verepedrol->surtidores = $surtidor1;
    $verepedrol->surtidores = $surtidor2;
    foreach($verepedrol->surtidores as $surtidor){
        $surtidor->mostrar();
    }

    echo "<b>Contratamos a un encargado:</b><br>";
    $verepedrol->contratarEncargado("Encargado","Numero 1",14,300);
    $verepedrol->encargado->mostrar();

    echo "<b>El encargado contrata a dos becarios:</b><br>";
    $verepedrol->becarios = $verepedrol->encargado->contratarBecarios("Ian","Real",23,"DAW");
    $verepedrol->becarios = $verepedrol->encargado->contratarBecarios("Álvaro","Molina",32,"DAM");
    foreach($verepedrol->becarios as $becario){
        $becario->mostrar();
    };

    echo "<b>Se venden 150 litros de diesel del primer surtidor:</b><br>";
    $verepedrol->venderCombustible(1,"diesel","150",$verepedrol->dineroEnCaja);
    echo "Dinero en caja: ".$verepedrol->dineroEnCaja."<br>";

    echo "<b>Se venden 850 litros de gasolina del segundo surtidor:</b><br>";
    $verepedrol->venderCombustible(2,"gasolina","850",$verepedrol->dineroEnCaja);
    echo "Dinero en caja: ".$verepedrol->dineroEnCaja."<br>";

    echo "<b>Se compran 150 litros de gasolina al primer surtidor:</b><br>";
    $verepedrol->comprarCombustible(1,"diesel","150",$verepedrol->dineroEnCaja);
    echo "Dinero en caja: ".$verepedrol->dineroEnCaja."<br>";

    echo "<b>Rellenamos los tanques del segundo surtidor al máximo:</b><br>";
    $verepedrol->comprarCombustible(2,"MAX","150",$verepedrol->dineroEnCaja);
    echo "Dinero en caja: ".$verepedrol->dineroEnCaja."<br>";

    echo "<b>Pagamos a todos los empleados:</b><br>";
    $verepedrol->pagarTrabajadores();
    echo "Dinero en caja: ".$verepedrol->dineroEnCaja."<br>";

    $verepedrol->mostrar();
?>