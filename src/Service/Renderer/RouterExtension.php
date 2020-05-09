<?php declare(strict_types=1);

namespace App\Service\Renderer;

use AltoRouter;
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

/**
 * Class RouterExtension
 *
 * @package App\Service\Renderer
 */
class RouterExtension implements ExtensionInterface
{
    /** @var AltoRouter  */
    private $router;

    /**
     * RouterExtension constructor.
     *
     * @param AltoRouter $router
     */
    public function __construct(AltoRouter $router)
    {
        $this->router = $router;
    }

    /**
     * @param Engine $engine
     */
    public function register(Engine $engine): void
    {
        $engine->registerFunction('genUrl', [$this, 'getUrl']);
    }

    /**
     * @param string $route
     * @param mixed[] $params
     *
     * @return string
     *
     * @throws \Exception
     */
    public function getUrl(string $route, array $params = []): string
    {
        return $this->router->generate($route, $params);
    }
}
