<?php
    require 'ConectaCuatro.php';
    $juego = new ConectaCuatro();
    while (true) {
        $juego->mueveMaquina();
        if ($juego->finalPartida('Máquina')) {
            echo $juego;
            echo 'Ha ganado la máquina<br>' . PHP_EOL;
            break;
        }
        $juego->mueveJugador();
        if ($juego->finalPartida('Jugador')) {
            echo $juego;
            echo 'Ha ganado el jugador<br>' . PHP_EOL;
            break;
        }
        if($juego->getMovimientos()==42){
            echo $juego;
            echo "ha habido empate". PHP_EOL;
            break;
        }

        echo $juego;
    }
    echo 'Número de movimientos: ' . $juego->getMovimientos() . '<br>' . PHP_EOL;
    $juego = null;
    echo $juego;
?>