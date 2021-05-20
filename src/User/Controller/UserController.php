<?php

declare(strict_types=1);

namespace App\User\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractFOSRestController
{
    public function getUserAction(UserInterface $user): View
    {
        return $this->view($user);
    }

    public function login(UserInterface $user): View
    {
        return $this->view($user);
    }
}
