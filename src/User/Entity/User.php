<?php

declare(strict_types=1);

namespace App\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
#[UniqueEntity(fields: 'username')]
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @ORM\Column(length=30, unique=true)
     */
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 30)]
    private string $username;

    /**
     * @ORM\Column
     */
    private string $password;

    #[Assert\NotBlank]
    #[Assert\Length(min: 8, max: 4096)]
    private string $plainPassword;

    private Token $currentToken;

    public function __construct(string $username, string $plainPassword)
    {
        $this->username = $username;
        $this->plainPassword = $plainPassword;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return $this
     */
    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    public function getCurrentToken(): Token
    {
        return $this->currentToken;
    }

    /**
     * @return $this
     */
    public function setCurrentToken(Token $currentToken): static
    {
        $this->currentToken = $currentToken;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * {@inheritDoc}
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function eraseCredentials()
    {
        unset($this->plainPassword);
    }
}
