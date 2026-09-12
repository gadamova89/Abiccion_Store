<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    //$_SESSION['rol'] = 'cliente';
}
//session_destroy();
// echo "sesion es:";
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
require_once 'app/config/config.php';
require_once CORE_PATH."Autoloader.php";
//require_once 'app/controllers/HomeController.php';

//las siguientes 3 lineas para el servidor
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$metodo = "index";
if (isset($_GET['url'])) {
    // echo " get [url] es: ";
    // print_r($_GET['url']);
    // echo "<br>";
    $uri = $_GET['url'];
    $uri = filter_var($uri, FILTER_SANITIZE_URL);
    $uri = trim($uri, "/");
    $uri = mb_strtolower($uri);
    $uri = str_replace('_','-', $uri);
    $uri = preg_replace("/[^a-zA-Z0-9\/-]/","",$uri);
    $uriSegments = explode('/', $uri);
    // echo "<br>";
    // print_r($uriSegments);
    $controlador= $uriSegments[0];
    
    if (!empty($uriSegments[1])) {
        if ($uriSegments != "") {
            $metodo = $uriSegments[1];
        }
    }
    $params = array_slice($uriSegments, 2);
    // echo "El controlador es: $controlador<br>";
    // echo "El metodo es: $metodo<br>";
    // echo "Los parametros son: ";
    // print_r($params);
    //echo "<br>";
    //echo "Existe Uri: $uri";
    $currentController=ucfirst($controlador)."Controller";
    // $obj = new $currentController();
    // $obj->$metodo();
    if(!class_exists($currentController) || !method_exists($currentController, $metodo)){
        //echo "<p>Error 404: No existe el controlador o el metodo</p>";
        $currentController= 'ErrorController';
        $metodo='index';
    }
    $controller = new $currentController();
    call_user_func_array([$controller, $metodo], $params);
}else {
    $error = new HomeController();
    $error->index();
}
