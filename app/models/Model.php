<?php

namespace App\Models;

use App\Database\Connection;
use PDO;
use ReflectionClass;


class Model
{
    protected static string $table;

    protected static function resolveTable(): string
    {
        return static::$table ?? strtolower((new ReflectionClass(static::class))->getShortName()) . 's';
    }

    public static function all(): array
    {
        $sql = "SELECT * FROM " . static::resolveTable();
        $results = Connection::query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => static::hydrate($row), $results);
    }

    public static function find(int $id): static|null

    {
        $sql = "SELECT * FROM " . static::resolveTable() . " WHERE id = :id";
        $stmt = Connection::query($sql, ['id' => $id]);
        $row = Connection::query($sql, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
        return $row ? static::hydrate($row) : null;
    }

    public static function delete(int $id): bool
    {
        $sql = "DELETE FROM " . static::resolveTable() . " WHERE id = :id";
        $stmt = Connection::query($sql, ['id' => $id]);
        return $stmt->rowCount() > 0;
    }

    public static function create(array $data): bool
    {
        $columns = array_keys($data);
        $placeholders = array_map(fn($key) => ":$key", $columns);

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            static::resolveTable(),
            implode(', ', $columns),
            implode(', ', $placeholders)
        );

        return Connection::query($sql, $data)->rowCount() > 0;
    }


    protected static function hydrate(array $data): static
    {
        $model = new static();
        foreach ($data as $key => $value) {
            $model->$key = $value;
        }
        return $model;
    }



    public function hasMany(string $relatedClass, string $foreignKey, string $localKey = 'id'): array
    {
        $relatedTable = $relatedClass::resolveTable();
        $sql = "SELECT * FROM $relatedTable WHERE $foreignKey = :value";
        return Connection::query($sql, ['value' => $this->$localKey])->fetchAll(PDO::FETCH_ASSOC);
    }

    public function belongsTo(string $relatedClass, string $foreignKey, string $ownerKey = 'id'): ?array
    {
        $relatedTable = $relatedClass::resolveTable();
        $sql = "SELECT * FROM $relatedTable WHERE $ownerKey = :value LIMIT 1";
        $stmt = Connection::query($sql, ['value' => $this->$foreignKey]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

}
