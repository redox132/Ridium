<?php

namespace Ridium\src\Commands;


class MakeModel
{
    public function handle($name)
    {
        $stubPath = __DIR__ . '/../../files/stubs/model.stub';
        $outputDir = __DIR__ . '/../../../app/Models';
        $outputFile = "{$outputDir}/{$name}.php";

        if (!file_exists($stubPath)) {
            echo "Stub not found.\n";
            return;
        }

        $stub = file_get_contents($stubPath);
        $content = str_replace('{{ className }}', $name, $stub);

        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        file_put_contents($outputFile, $content);
        echo "Model {$name} created at app/Models/{$name}.php\n";
        exit;
    }
}
