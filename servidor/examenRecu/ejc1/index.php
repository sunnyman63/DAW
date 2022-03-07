<?php

require_once "calendario.php";
require_once "evento.php";
require_once "urgente.php";
require_once "social.php";

$calendarioSocial = new calendario("Social");
$calendarioPersonal = new calendario("Personal");

$eventoEx = new urgente("examen",new DateTime("03/07/22 18:00:00"),5);
$eventoCine = new social("cine",new DateTime("03/07/22 18:00:00"),"La vereda multicines");
$eventoMed = new urgente("examen",new DateTime("03/07/22 17:00:00"),1);

$calendarioSocial->agregarEvento($eventoEx);
$calendarioSocial->agregarEvento($eventoCine);

$calendarioPersonal->agregarEventoRecurrente($eventoMed,3,5);

echo $calendarioSocial;
echo $calendarioPersonal;

echo "Evento examen<br>";
echo $calendarioSocial->obtenerEvento(1)."<br>";

$calendarioSocial->eliminarEvento(2);

echo $calendarioSocial;

?>