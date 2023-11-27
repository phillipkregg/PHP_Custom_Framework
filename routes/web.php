<?php

use App\Controllers\HomeController;
use App\Controllers\PostsController;
use PhilLackey\Framework\Http\Response;

return [
    ['GET', '/', [HomeController::class, 'index']],
    ['GET', '/posts/{id:\d+}', [PostsController::class, 'show']],
    [
        'GET', '/howdy/{name:.+}', function (string $name) {
        return new Response("Howdy $name");
    }
    ],
];