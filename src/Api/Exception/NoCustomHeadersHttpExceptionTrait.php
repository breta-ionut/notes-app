<?php

declare(strict_types=1);

namespace App\Api\Exception;

trait NoCustomHeadersHttpExceptionTrait
{
    public function getHeaders(): array
    {
        return [];
    }
}
