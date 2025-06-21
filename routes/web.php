<?php

use App\Controllers\HomeController;

// Controller-based

$router->get('/', function(){
    return view('welcome');
});


