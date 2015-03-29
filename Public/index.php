<?php

// Configuration
/*$basePath 	= "/home/u344336885/public_html/webservice/";
$baseUrl 	= "http://chefdesfourneaux-api.16mb.com/";
$host 		= "mysql.hostinger.fr";
$dbase 		= "u344336885_chef";
$user 		= "u344336885_namyn";
$password 	= "Fourneaux1234";
*/

$basePath 	= "C:\wamp\www\webservice\\";
$baseUrl 	= "http://localhost";
$host 		= "localhost";
$dbase 		= "fourneaux";
$user 		= "root";
$password 	= "";


// Chargement de l'autoloader
require_once('../Library/Loader/Autoloader.php');
$autoload = \Library\Loader\Autoloader::getInstance();
$autoload::setBasePath($basePath);

// Chargement des settings
$config = \Application\Configs\Settings::getInstance();
$config::setBaseUrl($baseUrl);
$config::readSettings();

// Connexion à la base de données
$DB = \Library\Model\Connexion::getInstance();
$DB::addConnexion($host, $DB::connectDB($host, $dbase, $user, $password));


// Chargement du routeur
//$router = \Library\Router\Router::getInstance();
//$router::dispatchPage($_GET['method']);



// Instanciation du serveur REST
$server = new \Library\Core\RestServer();
$server->handle();


/*var_dump($_SERVER["SCRIPT_FILENAME"]);
var_dump($_SERVER);*/


