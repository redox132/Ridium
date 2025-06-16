<?php

namespace App\Models;


class User extends Model
{
    // optional 
    // protected static string $table = 'users';

    public function posts(): array
    {
        return $this->hasMany(Post::class, 'user_id');
    }
    
}
