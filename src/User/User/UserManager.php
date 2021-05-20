<?php

declare(strict_types=1);

namespace App\User\User;

use App\User\Entity\User;
use App\User\Security\Authenticator\LoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class UserManager
{
    public function __construct(
        private UserPasswordEncoderInterface $userPasswordEncoder,
        private EntityManagerInterface $entityManager,
        private UserAuthenticatorInterface $userAuthenticator,
        private LoginAuthenticator $authenticator,
        private RequestStack $requestStack,
    ) {
    }

    public function create(User $user): void
    {
        $password = $this->userPasswordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function authenticate(User $user): void
    {
        $this->userAuthenticator->authenticateUser(
            $user,
            $this->authenticator,
            $this->requestStack->getCurrentRequest(),
        );
    }
}
