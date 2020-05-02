<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ErrorController
 *
 * @package App\Controller
 */
class ErrorController extends AbstractController
{
    /**
     * @param \Exception $error
     * @param int $status
     * @param bool $isJson
     *
     * @return Response
     */
    public function error(\Exception $error, int $status = 500, $isJson = false): Response
    {
        if ($isJson) {
            return $this->json(['error' => $status, 'msg' => $error->getMessage()], $status);
        } else {
            return $this->renderView("error/{$status}", ['error' => $error]);
        }
    }
}
