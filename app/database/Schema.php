<?php

namespace App\Database;


class Schema
{
    public static function create(string $table, callable $callback)
    {
        $blueprint = new Blueprint($table);
        $callback($blueprint);
        $sql = $blueprint->toSql();
        return $sql;
    }
}
