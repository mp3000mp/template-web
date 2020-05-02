<?php declare(strict_types=1);

namespace App\Service\Renderer;

use AltoRouter;
use DebugBar\StandardDebugBar;
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

/**
 * Class RouterExtension
 *
 * @package App\Service\Renderer
 */
class DebugBarExtension implements ExtensionInterface
{
    /** @var AltoRouter  */
    private $debugBar;

    /**
     * RouterExtension constructor.
     *
     * @param StandardDebugBar $debugBar
     */
    public function __construct(StandardDebugBar $debugBar)
    {
        $this->debugBar = $debugBar;
    }

    /**
     * @param Engine $engine
     */
    public function register(Engine $engine): void
    {
        $engine->registerFunction('renderDebugBarAssets', [$this, 'renderDebugBarAssets']);
        $engine->registerFunction('renderDebugBar', [$this, 'renderDebugBar']);
    }

    /**
     * render assets
     * @return string
     *
     * @throws \Exception
     */
    public function renderDebugBarAssets(): string
    {
        $s = '';
        $debugBarRenderer = $this->debugBar->getJavascriptRenderer();
        list($cssFiles, $jsFiles) = $debugBarRenderer->getAssets();

        // concat each css files
        foreach ($cssFiles as $file) {
            $file = '/build/debug/'.explode('Resources/', $file)[1];
            $s .= '<link rel="stylesheet" type="text/css" href="' . $file .'">';
        }

        // concat each js files
        foreach ($jsFiles as $file) {
            $file = '/build/debug/'.explode('Resources/', $file)[1];
            $s .= '<script type="text/javascript" src="' . $file . '"></script>';
        }
        return $s;
    }

    /**
     * @return string
     */
    public function renderDebugBar(): string
    {
        return $this->debugBar->getJavascriptRenderer()->render();
    }
}
