<?php declare(strict_types=1);

namespace App;

use App\Controller\ErrorController;
use App\Service\Router\RouterService;
use DI\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class App
 *
 * @package App
 */
class App
{
    /** @var Container  */
    private $container;
    /** @var Request  */
    private $request;
    /** @var RouterService  */
    private $routerService;

    /**
     * App constructor.
     *
     * @param RouterService $routerService
     */
    public function __construct(Container $container, Request $request, RouterService $routerService)
    {
        $this->container = $container;
        $this->request = $request;
        $this->routerService = $routerService;
    }

    /**
     * init application
     */
    public function run(): void
    {
        list($scope, $controller, $action, $params) = $this->routerService->getController($this->request->getMethod(), $this->request->getRequestUri());

        if (!is_callable([$controller, $action])) {
            $params     = ['message' => sprintf('Controller method "%s" unfound', "{$controller}#{$action}")];
            $controller = ErrorController::class;
            $action     = 'error';
        }

        // call controller
        $controller = $this->container->get($controller);

        // if not json, we need renderer
        $isJson = false !== mb_stripos($scope, 'json');

        if (!$isJson) {
            $controller->loadRenderer($this->container->get('renderer'));
        }

        // call controller
        try {
            $response = $this->container->call([$controller, $action], $params);
        } catch (\Exception $e) {
            $controller = ErrorController::class;
            $action     = 'error';
            $params     = ['error' => $e, 'status' => 500, 'isJson' => $isJson];
            $controller = $this->container->get($controller);

            if (!$isJson) {
                $controller->loadRenderer($this->container->get('renderer'));
            }
            $response = $this->container->call([$controller, $action], $params);
        }
        $response->send();
    }
}
