<?php
namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Testimonial;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TestimonialFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
       
        for ($i = 0; $i < 5; $i++) {
            $testimonial = new Testimonial();
            $testimonial->setLang('ru');
            $testimonial->setImage('pic2.jpg');
            $testimonial->setText($faker->paragraph(3));
            $testimonial->setRelation($this->getReference('user_1', User::class));
            $manager->persist($testimonial);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class, // Assurer que UserFixtures est chargé avant
        ];
    }
}