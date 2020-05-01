<?php declare(strict_types=1);

namespace App\Service\Renderer;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use Symfony\Component\Translation\Translator;

/**
 * Class TranslatorExtension
 *
 * @package App\Service\Renderer
 */
class TranslatorExtension implements ExtensionInterface
{
    /** @var Translator  */
    private $translator;

    /**
     * RouterExtension constructor.
     *
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param Engine $engine
     */
    public function register(Engine $engine): void
    {
        $engine->registerFunction('trans', [$this->translator, 'trans']);
    }
}
