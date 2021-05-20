<?php

declare(strict_types=1);

namespace App\User\Exception;

use App\Api\Exception\NoCustomHeadersHttpExceptionTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class AuthenticationFailedException extends \RuntimeException implements HttpExceptionInterface
{
    use NoCustomHeadersHttpExceptionTrait;

    public function __construct(int $code = 0, \Throwable $previous = null)
    {
        parent::__construct('Authentication failed.', $code, $previous);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatusCode(): int
    {
        return Response::HTTP_UNAUTHORIZED;
    }
}
