<?php

namespace Ridium\src\Commands;


class MakeView
{
    public function handle(?string $viewName): void
    {
        if (!$viewName) {
            echo "\nUsage: php bin/rida make:view ViewName\n\n";
            exit(1);
        }

        $stubPath = __DIR__ . '/../../files/stubs/view.stub';
        $targetDir = __DIR__ . '/../../../resources/views';

        // Sanitize view name and construct target file path
        $sanitizedName = str_replace('.', '/', $viewName);
        $targetFile = $targetDir . '/' . $sanitizedName . '.blade.php';

        // Check stub file
        if (!file_exists($stubPath)) {
            echo "\nView stub not found at: {$stubPath}\n\n";
            exit(1);
        }

        // Ensure subdirectories exist
        $subDir = dirname($targetFile);
        if (!is_dir($subDir)) {
            mkdir($subDir, 0777, true);
        }

        // Prevent overwriting existing view
        if (file_exists($targetFile)) {
            echo "\nView '{$viewName}' already exists at: resources/views/{$sanitizedName}.blade.php\n\n";
            exit(1);
        }

        // Replace placeholder and write file
        $stub = file_get_contents($stubPath);
        $stub = str_replace('{{viewName}}', $viewName, $stub);
        file_put_contents($targetFile, $stub);

        // Display success message
        $cyan = "\033[1;36m";
        $reset = "\033[0m";

        echo "\n{$cyan}View '{$viewName}' created at: resources/views/{$sanitizedName}.blade.php at " . date('Y-m-d H:i:s') . "{$reset}\n\n";
        exit;
    }
}
