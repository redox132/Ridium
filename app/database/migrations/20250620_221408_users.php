<?php

use App\Database\Schema;
use App\Database\Blueprint;
use App\Database\Connection;

return new class {
    public function up(PDO $pdo)
    {

    $users = Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->timestamps();
    });


    // Execute with PDO
    Connection::query($users);

    }

    public function down(PDO $pdo)
    {
        $pdo->exec("DROP TABLE IF EXISTS users");
    }
    
};



