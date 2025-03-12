<?php

namespace App\DataFixtures;

use App\Entity\Teachers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeachersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $teacher = new Teachers();
        $teacher->setLang('ru')
                ->setPictures('pic300.jpg')
                ->setName('john doe4')
                ->setWhatsapp('010203040506')
                ->setTelegram('010203040506')
                ->setTeams('010203040506')
                ->setViber('010203040506');

        $manager->persist($teacher);

        $manager->flush();
    }
}
