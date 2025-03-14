<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use App\Repository\SliderRepository;
use App\Repository\ParalaxRepository;
use App\Repository\TeachersRepository;
use App\Repository\ComercialRepository;
use App\Repository\TestimonialRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    public function __construct(
        private SliderRepository $sliderRepository,
        private ComercialRepository $comercialRepository,
        private ParalaxRepository $paralaxRepository,
        private TeachersRepository $teachersRepository,
        private TestimonialRepository $testimonialRepository,
        private BlogRepository $blogRepository
    ) {}

    #[Route([
        'ru' => '/',
        'en' => '/en',
        'pt' => '/pt',
        'de' => '/de',
    ], name: 'app_home')]
    public function index(Request $request): Response
    {
        $locale = $request->getLocale();

        return $this->render('home/index.html.twig', [
            'sliders' => $this->sliderRepository->findBy(['lang' => $locale]),
            'comercials' => $this->comercialRepository->findBy(['lang' => $locale]),
            'paralaxs' => $this->paralaxRepository->findBy(['lang' => $locale]),
            'teachers' => $this->teachersRepository->findBy(['lang' => $locale]),
            'testimonials' => $this->testimonialRepository->findBy(['lang' => $locale]),
            'blogs' => $this->blogRepository->findBy(['lang' => $locale]),
        ]);
    }
}