<?php

namespace App\Controller\Employee;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/employe', name: 'app_employe', methods: ['GET'])]
    public function index(): Response
    {
        return new Response('Bienvenue dans l’espace employé !');
    }
}