<?php
    require_once "bootstrap.php";
    require_once "../entity/equipo.php";
    //buscar por clave primaria
    //$eq = $em->find("equipo",1);
    //mostrar datos
    //echo $eq->getSocios();
    // $eq->setSocios(70000);
    // $em->flush();
    // $eq = $em->find("Equipo", 40); 
    // if(!$eq){ 
    //     echo "Equipo no encontrado"; 
    // } 

    // //insertar datos 
    // $nuevo = new equipo(); 
    // $nuevo->setNombre('Real Madrid'); 
    // $nuevo->setFundacion(1900); 
    // $nuevo->setSocios(50000); 
    // $nuevo->setCiudad('Madrid');

    // $em->persist($nuevo); 
    // $em->flush();

    $eq = $em->find("equipo",3);
    $em->remove($eq);
    $em->flush();
?>