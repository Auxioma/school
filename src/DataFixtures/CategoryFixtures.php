<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Lesson;
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
        $categories = [
            [
                'name' => '',
                'slug' => 'kursy-francuzskogo-yazyka',
                'lang' => 'ru',
                'parent' => [
                    [
                        'name' => 'Онлайн обучение',
                        'slug' => 'onlayn-obuchenie',
                        'lang' => 'ru',
                    ],
                    [
                        'name' => 'Для начинающих',
                        'slug' => 'dlya-nachinayushchikh',
                        'lang' => 'ru',
                    ],
                    [
                        'name' => 'Разговорный французский',
                        'slug' => 'razgovornyy-francuzskiy',
                        'lang' => 'ru',
                    ],
                    [
                        'name' => 'Подготовка к экзаменам DELF',
                        'slug' => 'podgotovka-k-ekzamenam-delf',
                        'lang' => 'ru',
                    ],
                    [
                        'name' => 'Французский для детей',
                        'slug' => 'francuzskiy-dlya-detey',
                        'lang' => 'ru',
                    ],
                    [
                        'name' => 'Интенсивные курсы',
                        'slug' => 'intensivnye-kursy',
                        'lang' => 'ru',
                    ],
                ],
            ],
        ];


        foreach ( $categories as $key => $value ) {
            $category = new Category();
            $category->setName($value['name']);
            $category->setImageName('1.jpg');
            $category->setSlug($value['slug']);
            $category->setIsOnline('1');
            $category->setLang($value['lang']);
            $category->setParent(null);
            $manager->persist($category);

            foreach ( $value['parent'] as $key => $value ) {
                $categorys = new Category();
                $categorys->setName($value['name']);
                $categorys->setImageName('1.jpg');
                $categorys->setSlug($value['slug']);
                $categorys->setIsOnline('1');
                $categorys->setLang($value['lang']);
                $categorys->setParent($category);
                $manager->persist($categorys);

                // I'm update a lesson
                $lesson = new Lesson();
                $lesson->setTitre('titre-' . $key);
                $lesson->setSlug('slug-'.$key);
                $lesson->setDescription('description' . $key);
                $lesson->setLang('ru');
                $lesson->setCategories($categorys);
                $manager->persist($lesson);
            }

            $manager->flush();
        }
    }
}
