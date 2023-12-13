<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrimaryController extends AbstractController
{
    #[Route('/primary', name: 'app_primary')]
    public function index(): Response
    {
        return $this->render('primary/index.html.twig', [
            'controller_name' => 'PrimaryController',
        ]);
    }
}
