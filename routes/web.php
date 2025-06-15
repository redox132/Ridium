<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;

$router->get('/', [HomeController::class, 'index']);

$router->post('/user/store', [UserController::class, 'store']);