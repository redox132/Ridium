<?php

declare(strict_types = 1);

session_name('request_session');
session_start();


require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/helpers/functions.php';

use App\Models\User;
use App\Models\Post;
// use App\Router;


// $router = new Router();


// require __DIR__ . '/routes/web.php';

// // Parse current request
// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Strips query string
// $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// // Route the request
// $router->route($uri, $method);



$user = User::find(1);

foreach ($user->posts() as $post) {
    echo $post['title']; // or hydrate Post model if needed
}

$post = Post::find(10);
$user = $post->user();
echo $user['name']; // or use $user->name if you hydrate to User



