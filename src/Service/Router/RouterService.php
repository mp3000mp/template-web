<?php declare(strict_types=1);

namespace App\Service\Router;

use AltoRouter;

/**
 * Class RouterService
 *
 * @package App\Service\Router
 */
class RouterService
{
    /** @var AltoRouter  */
    private $router;
    /** @var array */
    private $routesConfig;

    /**
     * RouterService constructor.
     *
     * @param AltoRouter $router
     * @param array $routesConfig
     */
    public function __construct(AltoRouter $router, array $routesConfig)
    {
        $this->router = $router;
        $this->routesConfig = $routesConfig;
    }

    /**
     * get scope, controller, method and parameters
     * @param string $method
     * @param string $url
     *
     * @return array
     */
    public function getController(string $method, string $url): array
    {
        $match = $this->router->match($url, $method);

        // if route found
        if (false !== $match) {
            list($controller, $action) = explode('#', $match['target']);
            $controller = 'App\\Controller\\' . $controller;
            $params = $match['params'];
            $scope = $this->getScope($match['name']);
        } else {
            // 404 error
            $controller = 'App\\Controller\\ErrorController';
            $action = 'error';
            $params = ['message' => '404', 404];
            $scope = 'error';
        }
        return [$scope, $controller, $action, $params];
    }

    /**
     * @param string $routeName
     *
     * @return string
     */
    private function getScope(string $routeName): string
    {
        foreach ($this->routesConfig as $scope => $routes) {
            if (array_key_exists($routeName, $routes)) {
                return $scope;
            }
        }
        return 'private';
    }
}
