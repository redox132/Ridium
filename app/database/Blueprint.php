<?php

namespace App\Database;

class Blueprint
{
    protected string $table;
    protected array $columns = [];

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function increments(string $name): static
    {
        $this->columns[] = "$name INT AUTO_INCREMENT PRIMARY KEY";
        return $this;
    }

    public function string(string $name, int $length = 255): static
    {
        $this->columns[] = "$name VARCHAR($length) NOT NULL";
        return $this;
    }

    public function integer(string $name): static
    {
        $this->columns[] = "$name INT NOT NULL";
        return $this;
    }

    public function text(string $name): static
    {
        $this->columns[] = "$name TEXT NOT NULL";
        return $this;
    }

    public function boolean(string $name): static
    {
        $this->columns[] = "$name BOOLEAN NOT NULL DEFAULT FALSE";
        return $this;
    }
    public function date(string $name): static
    {
        $this->columns[] = "$name DATE NOT NULL";
        return $this;
    }
    public function datetime(string $name): static
    {
        $this->columns[] = "$name DATETIME NOT NULL";
        return $this;
    }
    

    public function timestamps(): static
    {
        $this->columns[] = "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
        $this->columns[] = "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
        return $this;
    }

    public function toSql(): string
    {
        $columnsSql = implode(",\n    ", $this->columns);
        return "CREATE TABLE IF NOT EXISTS {$this->table} (\n    {$columnsSql}\n);";
    }
}
