<?php

declare(strict_types=1);

namespace App\Database\Migrations\Types;

class Type
{
    public static function integer(): string
    {
        return 'integer';
    }

    public static function string(): string
    {
        return 'string';
    }

    public static function text(): string
    {
        return 'text';
    }
}