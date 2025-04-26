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
        $teacher->setLang('ru');
        $teacher->setImageName('pic300.jpg');
        $teacher->setName('john doe4');
        $teacher->setWhatsapp('010203040506');
        $teacher->setTelegram('010203040506');
        $teacher->setTeams('010203040506');
        $teacher->setViber('010203040506');

        $manager->persist($teacher);

        $manager->flush();
    }
}
