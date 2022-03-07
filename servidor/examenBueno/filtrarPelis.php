<?php
 function crearRegistro(){
    require("conexionBBDD.php");
    $cine=$_POST["cine"];
    $peli=$_POST["peli"];
    $dia=$_POST["dia"];
    $cinelike="%".$cine."%";
    $pelilike="%".$peli."%";
    $dialike="%".$dia."%";
    
    try{
        $dbh = new PDO($dsn, $usuario, $clave, $options);
        $stmt = $dbh->prepare('select PELICULA.titulo,CINE.nombre,PROYECCION.horario from CINE inner join PROYECCION on CINE.cod_cine=PROYECCION.cod_cine inner join PELICULA on PELICULA.cod_peli=PROYECCION.cod_peli where PELICULA.titulo like "'.$pelilike.'" and CINE.nombre like "'.$cinelike.'" and PROYECCION.horario like "'.$dialike.'"');
        $stmt->bindParam(1,$peli);
        $stmt->bindParam(2,$cine);
        $stmt->bindParam(3,$dia);
        $stmt->setFetchMode(PDO::FETCH_BOUND);
        $stmt->execute();
        $stmt->bindColumn(1,$pelicula);
        $stmt->bindColumn(2,$cinema);
        $stmt->bindColumn(3,$horario);
        while ($row = $stmt->fetch()) {
            echo $pelicula." ".$cinema." ".$horario."\n"."\n";
        }     

    } catch (PDOException $e) {
            echo 'Error con la base de datos: ' . $e->getMessage();
    }
        
    
    
}
crearRegistro();



?>