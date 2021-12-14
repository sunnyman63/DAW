<?php
    require_once "agenda.php";
    require_once "contacto.php";
    require_once "profesional.php";

    echo "Creamos una agenda.<br>";
    $agenda = new agenda();
    $agenda->numeroContactos();

    echo "<br>";
    echo "Agregamos el contacto Antonio 555555555, María 444444444, Jonas 333333333<br>";
    $agenda->anyadirContacto(new contacto("555555555","Antonio"));
    $agenda->anyadirContacto(new contacto("444444444","María"));
    $agenda->anyadirContacto(new contacto("333333333","Jonas"));
    echo "<br>";
    echo "Listamos los contactos: <br>";
    $agenda->mostrarAgenda();
    echo "<br>";
    echo "Añadimos el contacto profesional profe 222222222 elprofe@profesor.es<br>";
    $agenda->anyadirContacto(new profesional("elprofe@profesor.es","222222222","profe"));
    echo "Añade un contacto con el número 111111111 sin nombre.<br>";
    $agenda->anyadirContacto(new contacto("111111111"));
    echo "<br>";
    echo "Buscamos el contacto de jonas:<br>";
    $agenda->buscarPorNombreContacto("profe");
    echo "<br>";
    echo "Listamos los contactos: <br>";
    $agenda->mostrarAgenda();
?>