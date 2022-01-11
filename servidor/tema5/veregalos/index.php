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

    // $user = $em->getRepository("usuario")->findOneBy(array('nick'=> 'Pablito'));
    // echo "<pre>";
    // print_r($user->mostrarUsuario());
    // echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="./css/estiloEntrada.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <form action="#" method="POST" class="formulario">
            <input type="text" name="user" placeholder="Usuario" class="text">
            <input type="password" name="contra" placeholder="Contraseña" class="text">
            <input type="submit" name="submit" value="Entrar" class="btnForm">
            <a href="./registro.php">Registrate ahora!!</a>
        </form>
    </div>
</body>
</html>