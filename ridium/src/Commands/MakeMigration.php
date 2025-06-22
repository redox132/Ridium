<?php

namespace Ridium\src\Commands;


class MakeMigration
{
    public function handle(?string $name): void
    {
        if (!$name) {
            echo "Usage: php bin/rida make:migration MigrationName\n";
            exit(1);
        }

        if (!str_ends_with($name, 's')) {
            $name .= 's';
        }

        $timestamp = date('Ymd_His');
        $filename = $timestamp . '_' . strtolower($name) . '.php';

        // Double-check suffix
        if (!str_ends_with($filename, 's.php')) {
            $filename = $timestamp . '_' . strtolower($name) . 's.php';
        }

        $stubPath = __DIR__ . '/../../files/stubs/migration.stub';
        $targetPath = __DIR__ . '/../../../app/database/migrations/' . $filename;

        if (!file_exists($stubPath)) {
            echo "Stub file not found at: $stubPath\n";
            exit(1);
        }

        if (!is_dir(dirname($targetPath))) {
            mkdir(dirname($targetPath), 0755, true);
        }

        $stubContent = file_get_contents($stubPath);
        $className = str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
        $stubContent = str_replace('{{ className }}', ucfirst($className), $stubContent);

        file_put_contents($targetPath, $stubContent);

        echo "-------------------------------------------------------------\n";
        echo "Migration created: app/database/migrations/{$filename}\n";
        echo "-------------------------------------------------------------\n";
        exit;
    }
}
