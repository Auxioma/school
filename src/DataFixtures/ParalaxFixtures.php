<?php

namespace App\DataFixtures;

use App\Entity\Paralax;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ParalaxFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $paralax = new Paralax();
        $paralax->setLang('ru')
                ->setTitre('Образование с рождения\nначинается с нас')
                ->setDescription('Наша детская академия совместно с одной из старейших частных школ создали совместный проект по подготовке к школе. Цель проекта - гармоничное развитие, социализация для поступления в лучшие учебные заведения нашего города.')
                ->setImage('bg1.png');

        $manager->persist($paralax);
        $manager->flush();
    }
}