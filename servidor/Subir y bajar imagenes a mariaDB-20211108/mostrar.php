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
    $stmt=$bd->prepare("select imagen from Alumnos where id=41");
    $stmt->execute();
    $stmt->bindColumn('imagen', $imagen);
    $stmt->fetch(PDO::FETCH_BOUND);
          
       
   } catch (PDOException $e) {
       echo 'Error con la base de datos: ' . $e->getMessage();
   } finally {
       if (isset($bd)) {
           $bd = null;
           echo 'Desconexión realizada con éxito!';
       }
   }
   

?>
<html>
<body bgcolor="#bed7c0">
<div class="main">
<h1>Mostrando imagen almacenada en MySQL</h1>
  <div class="panel panel-primary">
    <div class="panel-body">
       <?php echo "<img src= ' data:image/jpeg;base64,".base64_encode($imagen)."'/>";
       ?>
   
      </div> 
    </div>
 </div>  
</body>
</html>