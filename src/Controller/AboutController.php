<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use App\Repository\TeachersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AboutController extends AbstractController
{
    public function __construct(
        private TeachersRepository $teachersrepository,
        private BlogRepository $blogRepository,
    )
    {
    }

    #[Route([
        'ru' => '/o-нас',
        'en' => '/about',
        'pt' => '/sobre',
        'de' => '/über',
    ],  name: 'app_about')]
    public function index(Request $request): Response
    {
        return $this->render('about/index.html.twig', [
            'teachers' => $this->teachersrepository->findBy(['lang' => $request->getLocale()]),
            'blogs' => $this->blogRepository->findBy(['lang' => $request->getLocale()]),
        ]);
    }
}
