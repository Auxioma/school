<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création de l'admin
        $admin = new User();
        $admin->setEmail('admin@admin.admin');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, '000'));
        $admin->setIsVerified(true);
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);
        $this->addReference('user_admin1', $admin); // Ajout de la référence

        // Création d'autres utilisateurs
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setEmail("user$i@example.com");
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
            $user->setIsVerified(true);
            $user->setRoles(['ROLE_USER']);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
