<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFictures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        // admin
        $admin = new User();
        $admin->setEmail('admin@admin.admin');
        $admin->setPassword('000');
        $admin->setIsVerified(true);
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);


        $manager->flush();
    }
}
