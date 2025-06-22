<?php

namespace Ridium\src\Commands;

class MakeComponent {
    public function handle(string $name) {
        $targetDir = __DIR__ . '/../../../resources/views/Components';
        $componentName = ucfirst($name);
        $stubPath = __DIR__ . '/../../files/stubs/component.stub';

        $componentFile = "{$targetDir}/{$componentName}.blade.php";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        if (file_exists($componentFile)) {
            echo "Component {$componentName} already exists.\n";
            return;
        }

        $stubContent = file_get_contents($stubPath);
        if ($stubContent === false) {
            echo "Error reading stub file.\n";
            return;
        }

        $result = file_put_contents($componentFile, $stubContent);
        if ($result === false) {
            echo "Error writing component file.\n";
            return;
        }

        echo "---------------------------------------------------\n";
        echo "Component {$componentName} created successfully.\n";
        echo "---------------------------------------------------\n";
        exit;
    }
}
