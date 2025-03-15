<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Repository\LessonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LessonsController extends AbstractController
{
    public function __construct(
        private LessonRepository $lessonRepository
    )
    {
    }   
    #[Route([
        'ru' => '/занятия/{slug}',
        'en' => '/lessons/{slug}',
        'pt' => '/lessons/{slug}',
        'de' => '/cours/{slug}',
    ], name: 'app_lessons')]
    public function index($slug): Response
    {
        return $this->render('lessons/index.html.twig', [
            'lesson' => $this->lessonRepository->findOneBy(['slug' => $slug]),  
        ]);
    }
}
