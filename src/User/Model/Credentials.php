<?php

declare(strict_types=1);

namespace App\User\Model;

class Credentials
{
    public function __construct(private ?string $username = null, private ?string $password = null)
    {
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
