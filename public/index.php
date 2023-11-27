<?php

declare(strict_types=1);

use PhilLackey\Framework\Http\Kernel;
use PhilLackey\Framework\Http\Request;
use PhilLackey\Framework\Routing\Router;

define('BASE_PATH', dirname(__DIR__));

require_once dirname(__DIR__).'/vendor/autoload.php';

// Request received
$request = Request::createFromGlobals();

$router = new Router();


// Send response
$kernel = new Kernel($router);
$response = $kernel->handle($request);

$response->send();