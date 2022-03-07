<?php
    function crearSesion(){
        $sala=$_POST["sala"];
        $peli=$_POST["peli"];
        $datetime=$_POST["datetime"];
        $cine=$_POST["cine"];
        require("conexionBBDD.php");
        $cod_peli=obtenerCodPeli($peli);
        $cod_cine=obtenerCodCine($cine);
        if(!fechaCorrecta(new DateTime($datetime))){
            echo "fecha incorrecta";
        }else{
            try{
                $dbh = new PDO($dsn, $usuario, $clave, $options);
                $stmt = $dbh->prepare('insert into PROYECCION(cod_cine,cod_peli,horario,num_sala) values(?,?,?,?)');
                $stmt->bindParam(1,$cod_cine);
                $stmt->bindParam(2,$cod_peli);
                $stmt->bindParam(3,$datetime);
                $stmt->bindParam(4,$sala);
                $stmt->execute();     
                echo "creado correctamente";
            } catch (PDOException $e) {
                echo 'Error con la base de datos: ' . $e->getMessage();
            }
        }
    
            
    }
    function obtenerCodPeli($nombre){
        require("conexionBBDD.php");
        try{
            $dbh = new PDO($dsn, $usuario, $clave, $options);
            $stmt = $dbh->prepare('select cod_peli from PELICULA where titulo=?');

            $stmt->bindParam(1,$nombre);
            $stmt->setFetchMode(PDO::FETCH_BOUND);
            $stmt->execute();
            $stmt->bindColumn(1,$existe);
            $stmt->fetch();
            return $existe;

        } catch (PDOException $e) {
            echo 'Error con la base de datos: ' . $e->getMessage();
        }

        }
        function obtenerCodCine($nombre){
            require("conexionBBDD.php");
            try{
                $dbh = new PDO($dsn, $usuario, $clave, $options);
                $stmt = $dbh->prepare('select cod_cine from CINE where nombre=?');
    
                $stmt->bindParam(1,$nombre);
                $stmt->setFetchMode(PDO::FETCH_BOUND);
                $stmt->execute();
                $stmt->bindColumn(1,$existe);
                $stmt->fetch();
                return $existe;
    
            } catch (PDOException $e) {
                echo 'Error con la base de datos: ' . $e->getMessage();
            }
    
            }


        function fechaCorrecta($fecha){
            $date=new DateTime("tomorrow");
        
            if($fecha>$date){
                return true;
            }else{
                return false;
            }
            
        }
        crearSesion();

?>