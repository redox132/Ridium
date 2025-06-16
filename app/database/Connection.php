<?php

declare(strict_types=1);

namespace App\Database;

use Dotenv\Dotenv;
use PDO;
use PDOException;
use PDOStatement;


$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

class Connection
{
    static private $pdo;

    static private function connect(): void
    {
        if (self::$pdo === null) {
            $host = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
            $user = $_ENV['DB_USER'] ?? getenv('DB_USER');
            $dbname = $_ENV['DB_NAME'] ?? getenv('DB_NAME');
            $password = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD');

            if (!$host || !$user || !$dbname || !$password) {
                die('Database configuration is not set in the .env file.');
            }
        
            $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";

            try {
                self::$pdo = new PDO($dsn, $user, $password);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }
    }

    static public function getPDO(): PDO
    {
        self::connect();
        return self::$pdo;
    }

    static public function query(string $sql, array $params = []) :PDOStatement
    {
        self::connect();
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
