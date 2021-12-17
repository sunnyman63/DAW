<?php 
// Include Composer Autoload (relative to project root). 
require_once './vendor/autoload.php';

use Doctrine\ORM\Tools\Setup; 
use Doctrine\ORM\EntityManager;  

// ruta de la entidades 
$paths = array("./src/Entity"); 
// por el tema de los mensajes de error 
$isDevMode = true; 
// configuración de la BD: es por esto que hay que ocultarlo 
$dbParams = array( 
    'driver' => 'pdo_mysql', 
    'user' => 'root', 
    'password' => '', 
    'dbname' => 'mercado', 
    'host' => '127.0.0.1'); 
$config = Setup::createAnnotationMetadataConfiguration(
    $paths,
    $isDevMode,
    null,
    null,
    false
); 
$em = EntityManager::create($dbParams, $config); 
?>