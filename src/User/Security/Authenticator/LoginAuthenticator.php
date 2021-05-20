<?php

declare(strict_types=1);

namespace App\User\Security\Authenticator;

use App\Api\Exception\BadInputException;
use App\Api\Exception\ValidationException;
use App\User\Entity\User;
use App\User\Exception\AuthenticationFailedException;
use App\User\Model\Credentials;
use App\User\Token\TokenManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LoginAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private DenormalizerInterface $denormalizer,
        private ValidatorInterface $validator,
        private TokenManager $tokenManager,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function supports(Request $request): ?bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function authenticate(Request $request): PassportInterface
    {
        $credentials = $this->readCredentials($request);
        $this->validateCredentials($credentials);

        return new Passport(
            new UserBadge($credentials->getUsername()),
            new PasswordCredentials($credentials->getPassword())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        /** @var User $user */
        $user = $token->getUser();
        $user->setCurrentToken($this->tokenManager->getOrCreate($user));

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        throw new AuthenticationFailedException();
    }

    /**
     * @throws BadInputException
     */
    private function readCredentials(Request $request): Credentials
    {
        try {
            return $this->denormalizer->denormalize($request->request->all(), Credentials::class);
        } catch (ExceptionInterface $exception) {
            throw new BadInputException(0, $exception);
        }
    }

    /**
     * @throws ValidationException
     */
    private function validateCredentials(Credentials $credentials): void
    {
        $violations = $this->validator->validate($credentials);
        if (0 !== \count($violations)) {
            throw new ValidationException($violations);
        }
    }
}
