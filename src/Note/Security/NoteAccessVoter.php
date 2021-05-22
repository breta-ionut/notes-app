<?php

declare(strict_types=1);

namespace App\Note\Security;

use App\Note\Entity\Note;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class NoteAccessVoter extends Voter
{
    /**
     * {@inheritDoc}
     */
    public function supports(string $attribute, $subject): bool
    {
        return 'NOTE_ACCESS' === $attribute;
    }

    /**
     * {@inheritDoc}
     *
     * @throws \InvalidArgumentException
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        if (!$subject instanceof Note) {
            throw new \InvalidArgumentException(\sprintf(
                'The subject must be an instance of "%s", "%s" given.',
                Note::class,
                \get_debug_type($subject),
            ));
        }

        return $subject->getUser() === $token->getUser();
    }
}
