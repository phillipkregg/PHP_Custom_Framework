<?php

namespace PhilLackey\Framework\Routing;

use FastRoute\Dispatcher;
use PhilLackey\Framework\Http\HttpException;
use PhilLackey\Framework\Http\HttpRequestMethodException;
use PhilLackey\Framework\Http\Request;

use function FastRoute\simpleDispatcher;

class Router implements RouterInterface
{


    public function dispatch(Request $request): array
    {
        $routeInfo = $this->extractRouteInfo($request);

        [$handler, $vars] = $routeInfo;

        if (is_array($handler)) {
            [$controller, $method] = $handler;

            $handler = [new $controller, $method];
        }

        return [$handler, $vars];
    }

    /**
     * @throws HttpRequestMethodException
     */
    private function extractRouteInfo(Request $request)
    {
        // Create dispatcher
        $dispatcher = simpleDispatcher(function ($routeCollector) {
            $routes = include BASE_PATH.'/routes/web.php';

            foreach ($routes as $route) {
                $routeCollector->addRoute(...$route);
            }
        });

        // dispatch a URI to get the route info
        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getPathInfo(),

        );

        switch ($routeInfo[0]) {
            case Dispatcher::FOUND:
                return [$routeInfo[1], $routeInfo[2]];
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = implode(', ', $routeInfo[1]);
                throw new HttpRequestMethodException("The allowed methods are $allowedMethods");
            default:
                throw new HttpException('Not found');
        }
    }
}