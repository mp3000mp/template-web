<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Translator;

/**
 * Class AppController
 *
 * @package App\Controller
 */
class AppController extends AbstractController
{
    /**
     * @param string $lang
     */
    public function lang(string $lang, Request $request, Translator $translator): RedirectResponse
    {
        $translator->setLocale($lang);
        $request->getSession()->set('lang', $lang);

        return new RedirectResponse($request->headers->get('referer'));
    }

    /**
     * @return Response
     */
    public function home(Translator $translator): Response
    {
        return $this->renderView('app/index', [
            'msg' => 'Hello world !',
        ]);
    }

    /**
     * @return Response
     */
    public function test(): Response
    {
        return $this->redirectToRoute('test.test');
    }

    /**
     * @return Response
     */
    public function testTest(): Response
    {
        return $this->renderView('app/test', [

        ]);
    }
}
