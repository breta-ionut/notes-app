<?php

declare(strict_types=1);

namespace App\Frontend\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route(path: '{path<^(?!api/).*?>}', name: 'index')]
    public function index(): Response
    {
        return $this->render('frontend/index.html.twig');
    }
}
