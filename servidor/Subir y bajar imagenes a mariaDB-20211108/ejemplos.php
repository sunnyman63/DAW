<?php
$dsn = 'mysql:dbname=ejemplo1;host=localhost';
$usuario = 'root';
$clave = '';	
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => true 
);
try {
    $bd = new PDO($dsn, $usuario, $clave, $options);
    echo 'Conexión realizada con éxito<br>';

    if(isset($_POST["submit"])){
        $revisar = getimagesize($_FILES["image"]["tmp_name"]);
        if($revisar !== false){
            $image = $_FILES['image']['tmp_name'];
            $imgContenido = file_get_contents($image);
            $stmt=$bd->prepare("insert into Alumnos (nombre, apellido,edad, fecha, imagen) Values(?,?,?,?,?)");
            $nombre="Antonio";
                $apellido="Lopez";
            $edad=25;
            $fecha=new DateTime();
            $fecha=$fecha->format('Y-m-d H:i:s');
            $stmt->bindParam(1,$nombre);
            $stmt->bindParam(2,$apellido);
            $stmt->bindParam(3,$edad);
            $stmt->bindParam(4,$fecha);
            $stmt->bindParam(5,$imgContenido);

            $stmt->execute();
        }
    }

   } catch (PDOException $e) {
       echo 'Error con la base de datos: ' . $e->getMessage();
   } finally {
       if (isset($bd)) {
           $bd = null;
           echo 'Desconexión realizada con éxito!';
       }
   }
   