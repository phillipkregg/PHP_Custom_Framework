<?php

declare(strict_types=1);

use PhilLackey\Framework\Http\Request;
use PhilLackey\Framework\Http\Response;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Request received
$request = Request::createFromGlobals();

// Send response
$content = "<h1>Howdy ya'll</h1>";

$response = new Response(
    content: $content,
    status: 200,
    headers: []
);

$response->send();