<?php

declare(strict_types=1);

namespace App\User\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Credentials
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 30)]
    private ?string $username;

    #[Assert\NotBlank]
    #[Assert\Length(min: 8, max: 4096)]
    private ?string $password;

    public function __construct(string $username = null, string $password = null)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}
