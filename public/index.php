<?php

session_name('request_session');
session_start();


require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helpers/functions.php';


use App\Router;


$router = new Router();


require __DIR__ . '/../routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);


