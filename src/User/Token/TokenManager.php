<?php

declare(strict_types=1);

namespace App\User\Token;

use App\User\Entity\Token;
use App\User\Entity\User;
use App\User\Repository\TokenRepository;
use Doctrine\ORM\EntityManagerInterface;

class TokenManager
{
    /**
     * @param int $tokenAvailability In minutes.
     */
    public function __construct(
        private TokenRepository $repository,
        private EntityManagerInterface $entityManager,
        private int $tokenAvailability,
    ) {
    }

    public function getOrCreate(User $user): Token
    {
        if (null === ($token = $this->repository->findOneAvailableByUser($user))) {
            $token = $this->create($user);
        } else {
            $token->setExpiresAt($this->getExpiryTime());
        }

        $this->entityManager->flush();

        return $token;
    }

    private function create(User $user): Token
    {
        $token = new Token($this->getExpiryTime(), $user);

        $this->entityManager->persist($token);

        return $token;
    }

    private function getExpiryTime(): \DateTime
    {
        return new \DateTime(\sprintf('+%d minutes', $this->tokenAvailability));
    }
}
