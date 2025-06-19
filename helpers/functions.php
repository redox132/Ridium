<?php

declare(strict_types=1);


function basePath(string $path = ''): string
{
    return __DIR__ . '/../' . "$path";
}

function view(string $viewPath, array $data = [])
{

    $fullPath = basePath("resources/views/{$viewPath}.blade.php"); ;

    if (!file_exists($fullPath)) {
        throw new \Exception("View [{$viewPath}] not found.");
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


function color($text, $code) {
    return "\033[" . $code . "m" . $text . "\033[0m";
}

function colorPrompt($text) {
    return color($text, '36'); // Cyan
}

function colorOutput($text) {
    return color($text, '32'); // Green
}

function colorError($text) {
    return color($text, '31'); // Red
}
