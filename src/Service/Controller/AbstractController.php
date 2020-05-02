<?php declare(strict_types=1);

namespace App\Service\Controller;

use AltoRouter;
use League\Plates\Engine;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractController
 *
 * @package App\Service\Controller
 */
abstract class AbstractController
{
    /** @var AltoRouter */
    private $router;
    /** @var Engine */
    private $renderer;

    /**
     * @param AltoRouter $router
     * @param Engine $renderer
     */
    public function __construct(AltoRouter $router)
    {
        $this->router = $router;
    }

    /**
     * @param string $view
     * @param array $params
     *
     * @return Response
     */
    final protected function renderView(string $view, array $params = []): Response
    {
        return new Response($this->renderer->render($view, $params));
    }

    /**
     * @param string $route
     * @param array $params
     *
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    final protected function redirectToRoute(string $route, array $params = []): RedirectResponse
    {
        return new RedirectResponse($this->router->generate($route, $params));
    }

    /**
     * @param Engine $renderer
     */
    final public function loadRenderer(Engine $renderer): void
    {
        $this->renderer = $renderer;
    }

    /**
     * @param array $json
     * @param int $http_code
     *
     * @return Response
     */
    final protected function json(array $json, int $http_code = 200): Response
    {
        return new Response(json_encode($json), $http_code, [
            'Content-Type' => 'application/json',
        ]);
    }
}
