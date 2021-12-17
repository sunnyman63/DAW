<?php 
require_once "./bootstrap.php"; 
require_once './src/Entity/Producto.php'; 
require_once './src/Entity/Proveedor.php';  

$prov = $em->find("Proveedor", 1); 
if(!$prov) { 
    echo "Proveedor no encontrado"; 
} else {  
    $productos = $prov->productos;
    foreach($productos as $producto){ 
        echo "Nombre: ". $producto->nombre."<br>"; 
    } 
    $prod = new Producto();
    $prod->nombre = "platano";
    $prod->precio = 1;
    $prod->idproveedor = $prov;

    $em->persist($prod);
    $em->flush();
    $em->refresh($prov);

    echo "<br>";
    $productos = $prov->productos;
    foreach($productos as $producto){ 
        echo "Nombre: ". $producto->nombre."<br>"; 
    }
}