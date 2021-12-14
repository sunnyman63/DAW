<?php
    session_start();
    $cadError = "";
    $cadenaConexion = 'mysql:dbname=verelibros;host=127.0.0.1'; 
    $usuario = 'promotor'; 
    $clave = '123'; 
    $options = array( 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" 
    );

    function cerrarSesion($cadError) {
        $_SESSION = array();
        session_destroy();
        setcookie(session_name(),123,time()-10000);
        setcookie("error",$cadError,time() + 5);
        if(strcmp($_POST["tp"],"lo")==0) {
            header("Location: login.php");
        }
        if(strcmp($_POST["tp"],"re")==0) {
            header("Location: register.php");
        }
    }

    function rellenarSesion($nombre,$correo,$esAdmin) {
        $_SESSION["user"] = $nombre;
        $_SESSION["email"] = $correo;
        $_SESSION["esAdmin"] = $esAdmin;
        if($esAdmin==false) {
            header("Location: pagina.php");
        }
        if($esAdmin==true) {
            header("Location: paginaAdmin.php");
        }
        
    }


    try { 
        $bd = new PDO($cadenaConexion, $usuario, $clave, $options);
        if(strcmp($_POST["tp"],"lo")==0) {
            //FETCH_OBJ 
            $stmt = $bd->prepare('select * from usuario where nombre=:nombre'); 
            $stmt->bindParam(":nombre",$_POST["nombre"]);
            //Ejecutamos 
            $stmt->execute(); 
            //Obtenemos todas las tuplas en un array 
            //También podemos indicar el estilo de devolución 
            $clientes = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(empty($clientes)) {
                $cadError = "Usuario no Encontrado.";
            } else {
                foreach ($clientes as $cliente) {
                    $contra = $cliente->contrasenya;
                    if(password_verify($_POST["contra"],$contra)) {
                        $stmt = $bd->prepare('select * from admin where nombreUsu=:nombre'); 
                        $stmt->bindParam(":nombre",$_POST["nombre"]);
                        //Ejecutamos 
                        $stmt->execute();
                        $usu = "";
                        while($esAdmin = $stmt->fetch(PDO::PARAM_STR)) {
                            $usu = $esAdmin;   
                        }
                        if(empty($usu)) {
                            rellenarSesion($cliente->nombre,$cliente->correo,false);
                        }else {
                            rellenarSesion($cliente->nombre,$cliente->correo,true);
                        }
                    } else {
                        $cadError = "Contraseña incorrecta.";
                    }
                }
            }
        }
        
        if(strcmp($_POST["tp"],"re")==0) {
            class Usuario {
                public $nombre;
                public $correo;
                public $contrasenya;
        
                public function __construct($nombre,$correo,$contrasenya){
                    $this->nombre = $nombre;
                    $this->correo = $correo;
                    $this->contrasenya = password_hash($contrasenya,PASSWORD_DEFAULT);
                }
            }

            if($_POST["contra"]==$_POST["contrarep"]) {
                $cliente = new Usuario($_POST["nombre"],$_POST["correo"],$_POST["contra"]);
        
                //PREPARE -> BIND -> EXECUTE 
                //Prepare 
                $stmt = $bd->prepare("insert into usuario(nombre, correo, contrasenya) values(:nombre, :correo, :contrasenya)"); 
            
                //Execute
                if ($stmt->execute((array)$cliente)) { 
                    $stmt = $bd->prepare("insert into cliente(nombreUsu) values(:nombre)");
                    $stmt->bindParam(":nombre",$cliente->nombre);
                    $stmt->execute();
                    rellenarSesion($cliente->nombre,$cliente->correo,false);
                }
            } else {
                $cadError = "Las contraseñas no coinciden.";
            }    
        }
    } catch (PDOException $e) { 
        if(strpos($e,"PRIMARY")!=false) {
            $cadError = "Ya existe ese nombre de usuario.";
        } else {
            $cadError = "Error del servidor";
        }
    } finally { 
        if (isset($bd)) { 
            $bd = null; 
            if(!empty($cadError)){
                cerrarSesion($cadError);
            }
        } 
    }
?>