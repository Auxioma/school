<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Categoryshop;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Création des produits
        for ($i = 0; $i < 3; $i++) { // Adapter le nombre de produits à créer
            $product = new Product();
            $product->setName('Produit ' . $i);
            $product->setSlug('produit-' . $i);
            $product->setLang('fr');
            $product->setPicture('01.jpg');
            $product->setIsOnline(true);
            $product->setPrice('100.00');


            $product->setCategoryShop($this->getReference('category_0_' . $i, Categoryshop::class));


            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            NavshopFixtures::class, // Dépendance à NavshopFixtures
        ];
    }
}