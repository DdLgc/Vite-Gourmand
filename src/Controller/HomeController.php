<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(MenuRepository $menuRepository): Response
    {
        $menus = $menuRepository->findBy(
            ['isActive' => true],
            ['id' => 'DESC'],
            3
        );

        return $this->render('home/index.html.twig', [
            'menus' => $menus,
        ]);
    }
}