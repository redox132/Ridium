<?php

namespace App\Models;

use App\Database\Connection;
use PDO;

class User extends Model
{
    // optional 
    // protected static string $table = 'users';

    public function posts(): array
    {
        return $this->hasMany(Post::class, 'id');
    }
    
}
