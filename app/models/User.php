<?php

namespace App\Models;

class User extends Model
{
    // optional 
    // protected static string $table = 'users';

    
    function posts()
    {
        // Assuming a User has many Posts
        return $this->hasMany(ClassName::class, 'id');
        //or 
        return $this->belongsTo(ClassName::class, 'id');
    }

}
