<?php

namespace PhilLackey\Framework\Http;

use function FastRoute\simpleDispatcher;

class Kernel
{
    public function handle(Request $request): Response
    {
        // Create dispatcher
        $dispatcher = simpleDispatcher(function ($routeCollector) {
            $routeCollector->addRoute('GET', '/', function () {
                $content = '<h2>Howdy folks</h2>';

                return new Response(
                    $content,
                );
            });

            $routeCollector->addRoute('GET', '/posts/{id:\d+}', function ($routeParams) {
                $content = "<h2>This is post {$routeParams['id']}</h2>";

                return new Response(
                    $content,
                );
            });
        });

        // dispatch a URI to get the route info
        $routeInfo = $dispatcher->dispatch(
            $request->server["REQUEST_METHOD"],
            $request->server["REQUEST_URI"],
        );

        [$status, $handler, $vars] = $routeInfo;

        return $handler($vars);
    }
}