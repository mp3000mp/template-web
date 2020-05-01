<?php declare(strict_types=1);

namespace App;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class App
 *
 * @package App
 */
class App
{
    /** @var ContainerInterface */
    private $container;

    /**
     * App constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function run(): void
    {

        // load request/session
        /** @var Request $request */
        $request = $this->container->get('request');

        // load router
        /** @var \AltoRouter $router */
        $router = $this->container->get('router');

        // find route
        $match = $router->match($request->getRequestUri(), $request->getMethod());

        if (false !== $match) {
            list($controller, $action) = explode('#', $match['target']);
            $controller = 'App\\Controller\\' . $controller;
            $params = $match['params'];
            $routeName = $match['name'];

            if (!is_callable([$controller, $action])) {
                $controller = 'App\\Controller\\ErrorController';
                $action = 'error';
                $params = ['message' => sprintf('Controller method "%s" unfound', $match['target'])];
            } else {
                $scope = $this->getScope($routeName);
            }
        } else {
            $controller = 'App\\Controller\\ErrorController';
            $action = 'error'; // or is it 405
            $params = ['message' => '404', 404];
        }

        // call controller
        /** @var Response $response */
        $controller = $this->container->get($controller);

        if (false === mb_stripos($scope, 'json')) {
            $controller->loadRenderer($this->container->get('renderer'));
        }
        $response = $this->container->call([$controller, $action], $params);

        // send response
        $response->send();
    }

    /**
     * @param string $routeName
     *
     * @return string
     */
    private function getScope(string $routeName): string
    {
        $config = $this->container->get('config');
        $routeConfig = $config->get('app.routes');

        foreach ($routeConfig as $scope => $routes) {
            if (array_key_exists($routeName, $routes)) {
                return $scope;
            }
        }

        return 'private';
    }
}
