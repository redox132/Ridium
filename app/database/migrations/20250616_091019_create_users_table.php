<?php

return new class {
    public function up(PDO $pdo)
    {
        $pdo->exec("
           create table if not exists users (
               id int auto_increment primary key,
               name varchar(255) not null,
               email varchar(255) not null unique,
               password varchar(255) not null,
               created_at timestamp default current_timestamp,
               updated_at timestamp default current_timestamp on update current_timestamp
           )
        ");
    }

    public function down(PDO $pdo)
    {
        $pdo->exec("DROP TABLE IF EXISTS users");
    }
    
};