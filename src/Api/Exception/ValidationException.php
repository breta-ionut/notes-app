<?php

declare(strict_types=1);

namespace App\Api\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends \RuntimeException implements HttpExceptionInterface
{
    use NoCustomHeadersHttpExceptionTrait;

    public function __construct(
        private ConstraintViolationListInterface $constraintViolationList,
        int $code = 0,
        \Throwable $previous = null,
    ) {
        parent::__construct('Validation errors.', $code, $previous);
    }

    public function getConstraintViolationList(): ConstraintViolationListInterface
    {
        return $this->constraintViolationList;
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }
}
