<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class ErrorController
 *
 * @package App\Controller
 */
class ErrorController
{
    /**
     * @param string $message
     * @param int $status
     *
     * @return Response
     */
    public function error(string $message, int $status = 500): Response
    {
        return new Response($message, $status);
    }
}
