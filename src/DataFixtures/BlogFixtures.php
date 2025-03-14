<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Blog;
use App\Entity\User;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BlogFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $blog = new Blog();
            
            $blog->setTitre('Titre du blog n°' . $i)
                ->setSlug($this->slugger->slug('Titre du blog n°' . $i)->lower())
                ->setImages('pic1.jpg')
                ->setLang('ru')
                ->setDescription('Description du blog n°' . $i)
                ->setUser($this->getReference('user_1', User::class));

            $manager->persist($blog);
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


