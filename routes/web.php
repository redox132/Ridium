<?php

use App\Controllers\HomeController;

$router->get('/', function(){
    return view('welcome');
});


