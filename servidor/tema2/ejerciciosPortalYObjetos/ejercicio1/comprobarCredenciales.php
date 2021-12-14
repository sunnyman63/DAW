<?php
    session_start();
    $file = file("usuarios.txt");
    if(strcmp($_POST["tp"],"lo")==0) {
        if(empty($file)) {
            setcookie("errorLogin","UserNoExiste",time() + 5);
            header("Location: login.php?lg=".$_COOKIE["idiomaEjPreferencias"]);
        } else {
            foreach($file as $linea){
                $user = explode(";",$linea);
                $user[3] = trim($user[3],"\n");;
                if(in_array($_POST["nombre"],$user)){
                    if(in_array($_POST["contra"],$user)) {
                        $_SESSION["user"] = $_POST["nombre"];
                        $_SESSION["email"] = $user[1];
                        $_SESSION["ico"] = $user[3];
                        header("Location: pagina.php?lg=".$_COOKIE["idiomaEjPreferencias"]);
                    } else {
                        $_SESSION = array();
                        session_destroy();
                        setcookie(session_name(),123,time()-10000);
                        setcookie("errorLogin","ContraMal",time() + 5);
                        header("Location: login.php?lg=".$_COOKIE["idiomaEjPreferencias"]);
                    }
                } else {
                    $_SESSION = array();
                    session_destroy();
                    setcookie(session_name(),123,time()-10000);
                    setcookie("errorLogin","UserNoExiste",time() + 5);
                    header("Location: login.php?lg=".$_COOKIE["idiomaEjPreferencias"]);
                }
            }
        }
    }

    if(strcmp($_POST["tp"],"re")==0) {
        if(empty($file)) {
            $usuario = $_POST["nombre"].";".$_POST["email"].";".$_POST["contra"].";";

            if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
                $nombreDirectorio = "imgs/";   
                $idUnico = time();   
                $nombreFichero = $idUnico . "-" . $_FILES['imagen']['name']; 
                move_uploaded_file($_FILES['imagen']['tmp_name'],$nombreDirectorio.$nombreFichero);
                $usuario .= $nombreDirectorio.$nombreFichero;
                file_put_contents("usuarios.txt",$usuario,FILE_APPEND);
                $_SESSION["user"] = $_POST["nombre"];
                $_SESSION["email"] =  $_POST["email"];
                $_SESSION["ico"]=$nombreDirectorio.$nombreFichero;
                header("Location: pagina.php?lg=".$_COOKIE["idiomaEjPreferencias"]);
            } else {
                $_SESSION = array();
                session_destroy();
                setcookie(session_name(),123,time()-10000);
                setcookie("errorRegister","ErrorImagen",time() + 5);
                header("Location: login.php?lg=".$_COOKIE["idiomaEjPreferencias"]);
            }
        } else {
            foreach($file as $linea){
                $user = explode(";",$linea);
                $user[3] = trim($user[3],"\n");;
                if(in_array($_POST["nombre"],$user)){
                    $_SESSION = array();
                    session_destroy();
                    setcookie(session_name(),123,time()-10000);
                    setcookie("errorRegister","ErrorNombre",time() + 5);
                    header("Location: login.php?lg=".$_COOKIE["idiomaEjPreferencias"]);
                } else {
                    $usuario = $_POST["nombre"].";".$_POST["email"].";".$_POST["contra"].";";

                    if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
                        $nombreDirectorio = "imgs/";   
                        $idUnico = time();   
                        $nombreFichero = $idUnico . "-" . $_FILES['imagen']['name']; 
                        move_uploaded_file($_FILES['imagen']['tmp_name'],$nombreDirectorio.$nombreFichero);
                        $usuario .= $nombreDirectorio.$nombreFichero;
                        file_put_contents("usuarios.txt","\n".$usuario,FILE_APPEND);
                        $_SESSION["user"] = $_POST["nombre"];
                        $_SESSION["email"] =  $_POST["email"];
                        $_SESSION["ico"]=$nombreDirectorio.$nombreFichero;
                        header("Location: pagina.php?lg=".$_COOKIE["idiomaEjPreferencias"]);
                    } else {
                        $_SESSION = array();
                        session_destroy();
                        setcookie(session_name(),123,time()-10000);
                        setcookie("errorRegister","ErrorImagen",time() + 5);
                        header("Location: login.php?lg=".$_COOKIE["idiomaEjPreferencias"]);
                    }
                }
            }
        }
    }
   
?>