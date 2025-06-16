<?php


namespace App\Controllers;

use App\Http\Request;
use App\Models\User;

class UserController
{
    public function store()
    {
        // Validate input
        Request::validate($_POST, [
            'name' => ['required', 'min' => 3, 'max' => 50],
            'email' => ['required', 'email'],
            'password' => ['required', 'min' => 6, 'max' => 100]
        ]);

        // Save to database
        User::create([
            'username' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        ]);

        echo "User created successfully!";
    }
}
