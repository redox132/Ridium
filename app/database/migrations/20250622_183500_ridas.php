<?php

use App\Database\Schema;
use App\Database\Blueprint;
use App\Database\Connection;

return new class {
    public function up(PDO $pdo)
    {

    $Ridas = Schema::create('Ridas', function ($table) {
        $table->increments('id');
        $table->timestamps();
    });


    // Execute with PDO
    Connection::query($Ridas);

    }

    public function down(PDO $pdo)
    {
        $pdo->exec("DROP TABLE IF EXISTS Ridas");
    }
    
};



