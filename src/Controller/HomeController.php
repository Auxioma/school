<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    /**
     * Multilangue route 
     */
    #[Route([
        'ru' => '/',
        'en' => '/en',
        'pt' => '/pt',
        'de' => '/de',
    ], name: 'app_home')]
    public function index(Request $request): Response
    {


        return $this->render('home/index.html.twig');
    }
}
