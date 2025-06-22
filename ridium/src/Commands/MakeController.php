<?php

namespace Ridium\src\Commands;

class MakeController
{
    public function handle(?string $name): void
    {
        if (!$name) {
            echo "Usage: php bin/rida make:controller ControllerName\n";
            exit(1);
        }

        $controllerName = ucfirst($name);
        $stubPath = __DIR__ .  '/../../files/stubs/model.stub';
        $targetDir = __DIR__ . '/../../../app/controllers';
        $targetFile = "{$targetDir}/{$controllerName}.php";

        if (!file_exists($stubPath)) {
            echo "Controller stub not found at $stubPath\n";
            exit(1);
        }

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $stub = file_get_contents($stubPath);
        $stub = str_replace('{{ className }}', $controllerName, $stub);

        file_put_contents($targetFile, $stub);

        echo "\n";
        echo "--------------------------------------------------------------------\n";
        echo "\033[1;32mController {$controllerName}\033[0m created at app/controllers/{$controllerName}.php at " . date('Y-m-d H:i:s') . "\n";
        echo "--------------------------------------------------------------------\n\n";
        exit;
    }
}
