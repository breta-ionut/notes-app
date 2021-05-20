<?php

declare(strict_types=1);

namespace App\User\Security\UserProvider;

use App\User\Entity\User;
use App\User\Repository\TokenRepository;
use App\User\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class TokenUserProvider extends AbstractUserProvider
{
    public function __construct(UserRepository $userRepository, private TokenRepository $tokenRepository)
    {
        parent::__construct($userRepository);
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername(string $username): User
    {
        $token = $this->tokenRepository->findOneAvailableByToken($username);
        if (null === $token) {
            throw new UsernameNotFoundException(\sprintf('Token "%s" does not exist or is expired.', $username));
        }

        $user = $token->getUser();
        $user->setCurrentToken($token);

        return $user;
    }
}
