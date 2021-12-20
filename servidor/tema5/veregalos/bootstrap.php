<?php 
// Include Composer Autoload (relative to project root). 
require_once './vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable("./");
$dotenv->load();

// ruta de la entidades 
$paths = array("./src/Entity"); 
// por el tema de los mensajes de error 
$isDevMode = getenv("DEVMODE"); 
// configuración de la BD: es por esto que hay que ocultarlo 
$dbParams = array( 
    'driver' => $_ENV["DDBB_DRIVER"], 
    'user' => $_ENV["DDBB_USER"], 
    'password' => $_ENV["DDBB_PASS"], 
    'dbname' => $_ENV["DDBB_DBNAME"], 
    'host' => $_ENV["DDBB_HOST"]); 
$config = Setup::createAnnotationMetadataConfiguration(
    $paths,
    $isDevMode,
    null,
    null,
    false
); 
$em = EntityManager::create($dbParams, $config); 
?>