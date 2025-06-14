<?php

namespace App\Controllers;


class HomeController
{
    public function index()
    {
        $title = "Welcome to the Homepage";
        return view("resources/views/index.php", compact('title'));
    }

}