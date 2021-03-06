<?php

declare(strict_types=1);

namespace App\User\Security\Authenticator;

use App\User\Security\UserProvider\TokenUserProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class TokenAuthenticator extends AbstractAuthenticator
{
    public function __construct(private TokenUserProvider $userProvider)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function supports(Request $request): ?bool
    {
        return $request->headers->has('Authorization')
            && \str_starts_with($request->headers->get('Authorization'), 'Token ');
    }

    /**
     * {@inheritDoc}
     */
    public function authenticate(Request $request): PassportInterface
    {
        $token = \substr($request->headers->get('Authorization'), 6);

        return new Passport(new UserBadge($token, [$this->userProvider, 'loadUserByUsername']), new NullCredentials());
    }

    /**
     * {@inheritDoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        // Let the request continue with an anonymous user.
        return null;
    }
}
