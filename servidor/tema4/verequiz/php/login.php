<?php 
    session_start();
    $cadenaConexion = 'mysql:dbname=verequiz;host=127.0.0.1'; 
    $usuario = 'promotor'; 
    $clave = '123'; 
    $options = array( 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" 
    ); 
    try { 
        $bd = new PDO($cadenaConexion, $usuario, $clave, $options); 
        //FETCH_OBJ 
        $stmt = $bd->prepare('select * from usuario where nombre="'.$_POST["nombre"].'"'); 
        //Ejecutamos 
        $stmt->execute(); 
        //Obtenemos todas las tuplas en un array 
        //También podemos indicar el estilo de devolución 
        $clientes = $stmt->fetchAll(PDO::FETCH_OBJ);
        if(empty($clientes)) {
            session_unset();
            session_destroy();
            setcookie(session_name(),123,time()-1000);
            echo "Usuario no Encontrado.";
        } else {
            foreach ($clientes as $cliente) {
                $contra = $cliente->contrasenya;
                if(password_verify($_POST["contra"],$contra)) {
                    $_SESSION["user"] = $cliente->nombre;
                    $_SESSION["correo"] = $cliente->correo;
                    $_SESSION["puntuacion"] = 0;
                    $_SESSION["correctasSeguidas"] = 0; 
                    echo "0";
                } else {
                    session_unset();
                    session_destroy();
                    setcookie(session_name(),123,time()-1000);
                    echo "Contraseña incorrecta.";
                }
            }
        }    
    } catch (PDOException $e) {
        session_unset();
        session_destroy();
        setcookie(session_name(),123,time()-1000);
        echo $e; 
    } finally { 
        if (isset($bd)) { 
            $bd = null; 
        } 
    }
?>