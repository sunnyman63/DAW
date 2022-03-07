<?php
    function existeUsu($login){
        require("conexionBBDD.php");
        try{
            $dbh = new PDO($dsn, $usuario, $clave, $options);
            $stmt = $dbh->prepare('select dni from USUARIO where dni=?');

            $stmt->bindParam(1,$login);
            $stmt->setFetchMode(PDO::FETCH_BOUND);
            $stmt->execute();
            $stmt->bindColumn(1,$existe);
            $stmt->fetch();
            if($existe==""){
                return false;
            }else{
                return true;
            }

        } catch (PDOException $e) {
            echo 'Error con la base de datos: ' . $e->getMessage();
        }
    }
    function crearRegistro(){
        require("conexionBBDD.php");
        $nombre=$_POST["nombre"];
        $password=$_POST["pass"];
        $email=$_POST["email"];
        $dni=$_POST["dni"];
        $o=0;
        $hash= password_hash($password,  PASSWORD_BCRYPT, ['cost'=> 13]);
        if(existeUsu($dni)){
            return 0;
        }else{
            try{
                $dbh = new PDO($dsn, $usuario, $clave, $options);
                $stmt = $dbh->prepare('insert into USUARIO(dni,nombre,mail,es_admin,password) values(?,?,?,?,?)');
                $stmt->bindParam(1,$dni);
                $stmt->bindParam(2,$nombre);
                $stmt->bindParam(3,$email);
                $stmt->bindParam(4,$o);
                $stmt->bindParam(5,$hash);
                $stmt->execute();     
    
            } catch (PDOException $e) {
                echo 'Error con la base de datos: ' . $e->getMessage();
            }
            return $dni;
        }
        
    }
    echo crearRegistro();

    



?>