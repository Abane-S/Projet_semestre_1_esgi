<?php


// On récupére l'uri exemple /login et on récupère la correspondance 
// par exemple le controller Security et l'action login 
// Creation de l'instance de Security et on appel la method login()
// Si pas de correspondance alors on affichera une page 404


// echo "welcome";

namespace App;
use App\Controllers\Error;
use App\Controllers\EnvDecomposer;
use App\Core\View;

session_start();

spl_autoload_register("App\myAutoloader");

function myAutoloader(String $class): void
{
    //$class = App\Core\View
    $class = str_replace("App\\","", $class);
    //$class = Core\View
    $class = str_replace("\\","/", $class);
    //$class = Core/View
    if(file_exists($class.".php")){
        include $class.".php";
    }
}


$uri = strtolower($_SERVER["REQUEST_URI"]);
$uri = strtok($uri, "?");
$uri = strlen($uri)>1 ? rtrim($uri, "/"):$uri;


if(!file_exists("routes.yaml")){
    die("Le fichier de routing n'existe pas");
}


if (!file_exists('./.env') && $uri != "/installer") {
    header("Location: /installer");
    exit;
}
else if (file_exists('./.env'))
{
    $EnvDecomposer = new EnvDecomposer();

    define("PDO_DSN", $EnvDecomposer->getPdoString());
    define("TABLE_PREFIX", $EnvDecomposer->getTablePrefixString());
    define("SMTP_HOST", $EnvDecomposer->getSMTPHostString());
    define("SMTP_USERNAME", $EnvDecomposer->getSMTPUserNameString());
    define("SMTP_PASSWORD", $EnvDecomposer->getSMTPPasswordString());
    define("SMTP_PORT", $EnvDecomposer->getSMTPPortString());
    define("SMTP_EMAIL", $EnvDecomposer->getSMTPEmailString());
    define("SMTP_NAME", $EnvDecomposer->getSmtpNameString());
    define("SITE_NAME", $EnvDecomposer->getSiteNameString());
}

$routes = yaml_parse_file("routes.yaml");

$found = false;

foreach($routes as $pattern => $route) {
    $pattern = str_replace("{slug}", "([^/]+)", $pattern);
    $pattern = "@^".$pattern."$@i";
    
    if(preg_match($pattern, $uri, $matches)) {

        array_shift($matches);
        $_GET = array_merge($_GET, $matches);
        $found = $route;
        break;
    }
}

if($found) {
    
    if(empty($found["controller"]) || empty($found["action"])){
        die("Cette route ne possède pas de controller ou d'action dans le fichier de routing");
    }

    $controller = $found["controller"];
    $action = $found["action"];
    
    // Include the controller file.
    if(!file_exists("Controllers/".$controller.".php")){
        die("Le fichier Controllers/".$controller.".php n'existe pas");
    }
    include "Controllers/".$controller.".php";

    $controller = "\\App\\Controllers\\".$controller;

    // Check if the class exists.
    if(!class_exists($controller)){
        die("La classe ".$controller." n'existe pas");
    }

    $objController = new $controller();

    // Check if the action exists.
    if(!method_exists($objController, $action)){
        die("L'action ".$action." n'existe pas");
    }

    // Call the action.
    $objController->$action($_GET);
} else {
    // If no static route has been found, display a 404 error.
    $view = new View("Security/404", "front");
    $view->assign("showNavbar", "false");
}