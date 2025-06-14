<?php


function basePath(string $path = ''): string
{
    return __DIR__ . '/../' . "$path";
}

function view(string $viewPath, array $data = [])
{
    $fullPath = basePath($viewPath);

    if (!file_exists($fullPath)) {
        throw new \Exception("View [{$viewPath}] not found.");
    }

    extract($data);

    return require $fullPath;
}
