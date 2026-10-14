<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MenuController extends AbstractController
{
    #[Route('/menus', name: 'app_menu_index', methods: ['GET'])]
    public function index(MenuRepository $menuRepository): Response
    {
        $menus = $menuRepository->findBy(
            ['isActive' => true],
            ['createdAt' => 'DESC']
        );

        return $this->render('menu/index.html.twig', [
            'menus' => $menus,
        ]);
    }

    #[Route('/menus/{id}', name: 'app_menu_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(string $id, MenuRepository $menuRepository): Response
    {
        $menu = $menuRepository->findOneBy([
            'id' => $id,
            'isActive' => true,
        ]);

        if ($menu === null) {
            throw $this->createNotFoundException('Menu introuvable.');
        }

        return $this->render('menu/show.html.twig', [
            'menu' => $menu,
        ]);
    }
}
