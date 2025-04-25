<?php

namespace App\DataFixtures;

use App\Entity\Categoryshop;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class NavshopFixtures extends Fixture
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $categories = [
            [
                'name' => 'Catégorie 1',
                'slug' => 'categorie-1',
                'lang' => 'ru',
                'isOnline' => true,
                'subcategories' => [ // Renommer "parent" en "subcategories"
                    [
                        'name' => 'Sous-catégorie 1',
                        'slug' => 'sous-categorie-1',
                        'lang' => 'ru',
                        'isOnline' => true,
                    ],
                    [
                        'name' => 'Sous-catégorie 2',
                        'slug' => 'sous-categorie-2',
                        'lang' => 'ru',
                        'isOnline' => true,
                    ],
                    [
                        'name' => 'Sous-catégorie 3',
                        'slug' => 'sous-categorie-3',
                        'lang' => 'ru',
                        'isOnline' => true,
                    ],
                ],
            ],
        ];

        foreach ($categories as $key => $data) {
            $category = new Categoryshop();
            $category->setName($data['name']);
            $category->setSlug($this->slugger->slug($data['slug'])->toString());
            $category->setLang($data['lang']);
            $category->setIsOnline($data['isOnline']);
            $category->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($category);

            if (!empty($data['subcategories'])) { // Modifier pour vérifier les sous-catégories
                foreach ($data['subcategories'] as $subKey => $subData) {
                    $subcategory = new Categoryshop();
                    $subcategory->setName($subData['name']);
                    $subcategory->setSlug($this->slugger->slug($subData['slug'])->toString());
                    $subcategory->setLang($subData['lang']);
                    $subcategory->setIsOnline($subData['isOnline']);
                    $subcategory->setParent($category);
                    $subcategory->setCreatedAt(new \DateTimeImmutable());

                    // Ajouter une référence pour que ProductFixtures puisse y accéder
                    $this->addReference('category_' . $key . '_' . $subKey, $subcategory);

                    $manager->persist($subcategory);
                }
            }
        }

        $manager->flush();
    }
}