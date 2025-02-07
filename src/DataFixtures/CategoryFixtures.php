<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        /**
         * Create menu with submenu for school
         * russian, english, portuguese, german
         */
        $category = [
            1 => [
                'name' => 'adult',
                'picture' => 'adult.jpg',
                'slug' => 'adult',
                'isActive' => true,
                'lang' => 'ru',
                'parent' => [
                    1 => [
                        'name' => 'lesson 1',
                        'picture' => 'school.jpg',
                        'slug' => 'lesson-1',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ],
                    2 => [
                        'name' => 'lesson 2',
                        'picture' => 'school.jpg',
                        'slug' => 'lesson-2',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ],
                    3 => [
                        'name' => 'lesson 3',
                        'picture' => 'school.jpg',
                        'slug' => 'lesson-3',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ]
                ]
            ],
            2 => [
                'name' => 'children',
                'picture' => 'children.jpg',
                'slug' => 'children',
                'isActive' => true,
                'lang' => 'ru',
                'parent' => [
                    1 => [
                        'name' => 'lesson 1',
                        'picture' => 'school.jpg',
                        'slug' => 'lesson-1',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ],
                    2 => [
                        'name' => 'lesson 2',
                        'picture' => 'school.jpg',
                        'slug' => 'lesson-2',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ],
                    3 => [
                        'name' => 'lesson 3',
                        'picture' => 'school.jpg',
                        'slug' => 'lesson-3',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ]
                ]
            ]
        ];

        foreach ( $category as $key => $value ) {
            $category = new Category();
            $category->setName($value['name']);
            $category->setPicture($value['picture']);
            $category->setSlug($value['slug']);
            $category->setIsActive($value['isActive']);
            $category->setLang($value['lang']);
            $category->setParent(null);
            $manager->persist($category);

            foreach ( $value['parent'] as $key => $value ) {
                $categorys = new Category();
                $categorys->setName($value['name']);
                $categorys->setPicture($value['picture']);
                $categorys->setSlug($value['slug']);
                $categorys->setIsActive($value['isActive']);
                $categorys->setLang($value['lang']);
                $categorys->setParent($category);
                $manager->persist($categorys);
            }

            $manager->flush();
        }
    }
}
