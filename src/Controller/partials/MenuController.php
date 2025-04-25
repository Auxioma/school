<?php

namespace App\Controller\partials;

use App\Repository\CategoryRepository;
use App\Repository\CategoryshopRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    public function menu(CategoryRepository $categories, CategoryshopRepository $shop, Request $request)
    {

        $category = $categories->findby(['parent' => null, 'lang' => $request->getLocale()]);
        $shop = $shop->findby(['parent' => null, 'lang' => $request->getLocale()]);

        return $this->render('partials/menu.html.twig', [
            'categories' => $category,
            'shops' => $shop,
        ]);
    }
}