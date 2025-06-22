<?php

namespace Ridium\src\Commands;

use App\Database\Connection;

class RunMigrations
{
    public function handle(): void
    {
        $pdo = Connection::getPDO();
        $migrationsDir = __DIR__ . '/../../../app/database/migrations';

        if (!is_dir($migrationsDir)) {
            echo "Migrations folder not found at {$migrationsDir}.\n";
            exit(1);
        }

        // Create `migrations` table if it doesn't exist
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                batch INT NOT NULL,
                migrated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");

        // Get already run migrations
        $ran = $pdo->query("SELECT name FROM migrations")->fetchAll(\PDO::FETCH_COLUMN);
        $batch = (int)$pdo->query("SELECT MAX(batch) FROM migrations")->fetchColumn() + 1;

        $files = array_diff(scandir($migrationsDir), ['.', '..']);
        $ranCount = 0;

        foreach ($files as $file) {
            if (in_array($file, $ran)) {
                continue;
            }

            echo "Running: {$file}\n";

            $migration = require "{$migrationsDir}/{$file}";

            if (!is_object($migration) || !method_exists($migration, 'up')) {
                echo "Invalid migration: {$file}. Expected object with an 'up' method.\n";
                exit(1);
            }

            $migration->up($pdo);

            $stmt = $pdo->prepare("INSERT INTO migrations (name, batch) VALUES (?, ?)");
            $stmt->execute([$file, $batch]);

            $ranCount++;
        }

        if ($ranCount === 0) {
            echo "No new migrations to apply.\n";
        } else {
            echo "Applied {$ranCount} migration(s).\n";
        }
        exit;
    }
}
