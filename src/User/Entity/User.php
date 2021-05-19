<?php

declare(strict_types=1);

namespace App\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @ORM\Column(unique=true)
     */
    private string $username;

    /**
     * @ORM\Column(length=4096)
     */
    private string $password;

    private string $plainPassword;

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

    /**
     * @return $this
     */
    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
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

    /**
     * @return $this
     */
    public function setPlainPassword(string $plainPassword): static
    {
        $this->plainPassword = $plainPassword;

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
