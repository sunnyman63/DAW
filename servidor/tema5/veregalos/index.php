<?php
    require_once "./bootstrap.php"; 
    require_once "./src/Entity/Usuario.php";
    require_once "./src/Entity/Regalo.php";

    // $usu = new Usuario();
    // $usu->nick = "Pablito";
    // $usu->correo = "pabl1toM0laMas@gmail.com";
    // $usu->password = password_hash("1234",PASSWORD_DEFAULT);
    // $usu->esRey = 0;
    // $usu->buenometro = 42;

    // print_r($usu);

    // $em->persist($usu);
    // $em->flush();

    // $user = $em->getRepository("usuario")->findOneBy(array('nick'=> 'Pablito'));
    // echo "<pre>";
    // foreach($user->regalo as $regal) {
    //     echo $regal->nombre."<br>";
    // }
    // echo "</pre>";

    // echo "<br>";
    // $regalo = $em->getRepository("regalo")->findOneBy(array('nombre'=>"PS5"));
    // $user->anyadirRegaloALaCarta($em,$regalo);

    // $em->refresh($user);
    // echo "<pre>";
    // foreach($user->regalo as $regal) {
    //     echo $regal->nombre."<br>";
    // }
    // echo "</pre>";

    // echo "<br>";
    // $user->eliminarRegaloDeLaCarta($em,$regalo);
    // $em->refresh($user);
    // echo "<pre>";
    // foreach($user->regalo as $regal) {
    //     echo $regal->nombre."<br>";
    // }
    // echo "</pre>";

    // echo "<pre>";
    // $user->mostrarCarta($em);
    // echo "</pre>";

    // $users = regalo::listarTodosLosRegalos($em);
    // echo "<pre>";
    // print_r($users);
    // echo "</pre>";

    $user = $em->getRepository("usuario")->findOneBy(array('nick'=> 'Pablito'));
    echo "<pre>";
    print_r($user->mostrarUsuario());
    echo "</pre>";
?>