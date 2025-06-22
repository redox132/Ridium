<?php

namespace Ridium\src\Commands;

class MakeFactory
{
    public function handle(?string $name): void
    {
        if (!$name) {
            echo "\nDid you mean: php bin/rida make:factory FactoryName\n\n";
            exit(1);
        }

        // Sanitize and format the factory name
        $factoryName = preg_replace('/[^A-Za-z0-9]/', '', ucfirst($name));
        if (!$factoryName) {
            echo "\nInvalid factory name provided.\n";
            exit(1);
        }

        $factoryDir = __DIR__ . '/../../../app/database/factories';
        $stubPath = __DIR__ .  '/../../files/stubs/factory.stub';
        $targetFile = "{$factoryDir}/{$factoryName}.php";

        if (!file_exists($stubPath)) {
            echo "\nFactory stub not found at: {$stubPath}\n\n";
            exit(1);
        }

        if (!is_dir($factoryDir)) {
            mkdir($factoryDir, 0777, true);
        }

        if (file_exists($targetFile)) {
            echo "\nFactory '{$factoryName}' already exists!\n\n";
            exit(1);
        }

        $stub = file_get_contents($stubPath);
        $stub = str_replace('{{ className }}', $factoryName, $stub);

        file_put_contents($targetFile, $stub);

        echo "\n\n\033[1;36mFactory '{$factoryName}' created successfully at: app/database/factories/{$factoryName}.php\033[0m\n\n";
        exit;
    }
}
