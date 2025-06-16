<?php

namespace App\Models;


class Post extends Model
{
    // optional 
    // protected static string $table = 'posts';

    public function user(): ?array
    {
        return $this->belongsTo(User::class ,'id');
    }
}
