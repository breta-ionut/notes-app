<?php

declare(strict_types=1);

namespace App\User\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Credentials
{
    #[Assert\NotBlank]
    private string $username;

    #[Assert\NotBlank]
    #[Assert\Length(max: 4096)]
    private string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
