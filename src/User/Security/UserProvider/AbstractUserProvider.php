<?php

declare(strict_types=1);

namespace App\User\Security\UserProvider;

use App\User\Entity\User;
use App\User\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

abstract class AbstractUserProvider implements UserProviderInterface
{
    public function __construct(protected UserRepository $userRepository)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user): User
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(\sprintf(
                'Users of type "%s" are not supported.',
                \get_debug_type($user),
            ));
        }

        $userId = $user->getId();
        $refreshedUser = $this->userRepository->find($userId);

        if (null === $refreshedUser) {
            throw new UsernameNotFoundException(\sprintf('No user with id "%d" found.', $userId));
        }

        return $refreshedUser;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass(string $class): bool
    {
        return User::class === $class;
    }
}
