<?php

namespace App\DataFixtures;

use App\Entity\Slider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SliderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sliders = [
            [
                'picture' => 'slider-1.png',
                'lang' => 'ru',
                'titre' => 'Добро пожаловать',
                'description' => 'Лучшие курсы по программированию',
                'slug' => 'dobro-pozhalovat'
            ],
            [
                'picture' => 'slider-1.png',
                'lang' => 'ru',
                'titre' => 'Изучи новые технологии',
                'description' => 'Освой современные языки программирования',
                'slug' => 'izuchi-novye-tekhnologii'
            ],
            [
                'picture' => 'slider-1.png',
                'lang' => 'ru',
                'titre' => 'Будущее за IT',
                'description' => 'Начни свой путь в IT уже сегодня',
                'slug' => 'budushchee-za-it'
            ]
        ];

        foreach ($sliders as $data) {
            $slider = new Slider();
            $slider->setPicture($data['picture']);
            $slider->setLang($data['lang']);
            $slider->setTitre($data['titre']);
            $slider->setDescription($data['description']);
            $slider->setSlug($data['slug']);

            $manager->persist($slider);
        }

        $manager->flush();
    }
}
