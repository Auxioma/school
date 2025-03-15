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
                'name' => 'занятия',
                'picture' => 'adult.jpg',
                'slug' => 'занятия',
                'isActive' => true,
                'lang' => 'ru',
                'parent' => [
                    1 => [
                        'name' => 'онлайн',
                        'picture' => 'school.jpg',
                        'slug' => 'онлайн',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ],
                    2 => [
                        'name' => 'дети',
                        'picture' => 'school.jpg',
                        'slug' => 'дети',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ],
                    3 => [
                        'name' => 'начинающие',
                        'picture' => 'school.jpg',
                        'slug' => 'начинающие',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ],
                    4 => [
                        'name' => 'разговорный',
                        'picture' => 'school.jpg',
                        'slug' => 'разговорный',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ],
                    5 => [
                        'name' => 'экзамены',
                        'picture' => 'school.jpg',
                        'slug' => 'экзамены',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ],
                    6 => [
                        'name' => 'лето',
                        'picture' => 'school.jpg',
                        'slug' => 'лето',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ],
                    7 => [
                        'name' => 'Нормандия',
                        'picture' => 'school.jpg',
                        'slug' => 'Нормандия',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ],
                    7 => [
                        'name' => 'вопросы — ответы',
                        'picture' => 'school.jpg',
                        'slug' => 'вопросы — ответы',
                        'isActive' => true,
                        'lang' => 'ru',
                        'parent' => null
                    ],
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
