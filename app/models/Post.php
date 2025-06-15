<?php

namespace App\Models;

use App\Database\Connection;
use PDO;

class Post extends Model
{
    // optional 
    // protected static string $table = 'posts';

    public function user(): ?array
    {
        return $this->belongsTo(User::class, 'id');
    }
}
