<?php

namespace App\Router;

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use Psr\Container\ContainerInterface;

class Router
{

    private ContainerInterface $container;

    public function __construct()
    {
        $this->container = require __DIR__ . '/../../bootstrap.php';
    }


    public function dispatch(): void
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $r) {
            require __DIR__ . '/../../config/routes.php';
        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                http_response_code(404);
                echo "404 Not Found";
                break;

            case Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                $allowedMethods = $routeInfo[1];
                echo "405 Method Not Allowed. Métodos permitidos: " . implode(', ', $allowedMethods);
                break;

            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                $this->handle($handler, $vars);
                break;
        }
    }

    private function handle($handler, array $vars): void
    {

        if (is_callable($handler)) {
            call_user_func_array($handler, $vars);
            return;
        }

        if (is_string($handler)) {
            [$controllerName, $methodName] = explode('@', $handler);
            $controllerClass = "\\App\\Controller\\$controllerName";

            if (!class_exists($controllerClass)) {
                echo "Erro: Controller $controllerName não encontrado.";
                return;
            }

            $controller = $this->container->get($controllerClass);

            if (!method_exists($controller, $methodName)) {
                echo "Erro: Método $methodName não encontrado no controller $controllerName.";
                return;
            }

            call_user_func_array([$controller, $methodName], $vars);
        }
    }
}
