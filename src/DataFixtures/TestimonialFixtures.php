<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Testimonial;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TestimonialFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $testimonial = new Testimonial();
            $testimonial->setImage($faker->imageUrl(200, 200));
            $testimonial->setText($faker->paragraph(3));
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
