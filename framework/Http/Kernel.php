<?php

namespace PhilLackey\Framework\Http;

use Exception;

use PhilLackey\Framework\Routing\Router;

use function FastRoute\simpleDispatcher;

class Kernel
{
    public function __construct(private Router $router)
    {
    }

    public function handle(Request $request): Response
    {
        try {
            [$routeHandler, $vars] = $this->router->dispatch($request);

            $response = call_user_func_array($routeHandler, $vars);
        } catch (Exception $exception) {
            $response = new Response($exception->getMessage(), 400);
        }

        return $response;
    }
}