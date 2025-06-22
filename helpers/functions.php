<?php

declare(strict_types=1);


function basePath(string $path = ''): string
{
    return __DIR__ . '/../' . "$path";
}

function view(string $viewPath, array $data = [])
{

    $fullPath = __DIR__ . "/../resources/views/{$viewPath}.blade.php";

    if (!file_exists($fullPath)) {
        throw new \Exception("view [{$viewPath}] not found at $fullPath");
    }

    extract($data);

    return require $fullPath;
}


function redirect(string $path): void
{
    header("Location: /{$path}");
    http_response_code(302);
    exit();
}


