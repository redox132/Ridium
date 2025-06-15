<?php

declare(strict_types = 1);

namespace App\Controllers;


class HomeController
{
    public function index()
    {
        $title = "Welcome to Rida Framework";
        return view("resources/views/index.php", compact('title'));
    }

}