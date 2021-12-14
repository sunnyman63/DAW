<?php
    use ALUMNO\DAW as MOLA;
    use ALUMNO\ASIR as PRINGAO;
    require_once "./nombre1/profe.php";
    //use PROFESOR\profe;
    require_once "./nombre2/alumno.php";
    require_once "./nombre3/alumno.php";

    //$p = new profe();
    // $p = new PROFESOR\profe();
    // $p->saludar();

    // $d = new ALUMNO\DAW\alumno();
    // $d->saludar();

    // $a = new alumno();
    // $a->saludar();

    $d = new MOLA\alumno();
    $d->saludar();
    $e = new PRINGAO\alumno();
    $e->saludar();
?>