<?php

declare(strict_types=1);

use PhilLackey\Framework\Http\Kernel;
use PhilLackey\Framework\Http\Request;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Request received
$request = Request::createFromGlobals();

// Send response
$kernel = new Kernel();
$response = $kernel->handle($request);

$response->send();