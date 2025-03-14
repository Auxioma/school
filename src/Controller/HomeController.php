<?php

namespace App\Controller;

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
        private TeachersRepository $teachersrepository,
        private TestimonialRepository $testimonialRepository,
    )
    {
    }
    #[Route([ 
        'ru' => '/',
        'en' => '/en',
        'pt' => '/pt',
        'de' => '/de',
    ], name: 'app_home')]
    public function index(Request $request): Response
    {
        return $this->render('home/index.html.twig', [
            'sliders' => $this->sliderRepository->findBy(['lang' => $request->getLocale()]),
            'comercials' => $this->comercialRepository->findBy(['lang' => $request->getLocale()]),
            'paralaxs' => $this->paralaxRepository->findBy(['lang' => $request->getLocale()]),
            'teachers' => $this->teachersrepository->findBy(['lang' => $request->getLocale()]),
            'testimonials' => $this->testimonialRepository->findBy(['lang' => $request->getLocale()]),
        ]);
    }
}
