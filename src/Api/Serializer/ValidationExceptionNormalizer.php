<?php

declare(strict_types=1);

namespace App\Api\Serializer;

use App\Api\Exception\ValidationException;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

class ValidationExceptionNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * {@inheritDoc}
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        $data = $this->normalizer->normalize(
            $object,
            $format,
            ['bypass_validation_exception_normalizer' => true] + $context,
        );

        $violationsData = $this->normalizer->normalize(
            $context['exception']->getConstraintViolationList(),
            $format,
            $context,
        );

        return ['detail' => $violationsData['detail'], 'violations' => $violationsData['violations']] + $data;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof FlattenException
            && isset($context['exception'])
            && $context['exception'] instanceof ValidationException
            && empty($context['bypass_validation_exception_normalizer']);
    }
}
