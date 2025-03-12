<?php

namespace App\DataFixtures;

use App\Entity\Translation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TranslationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $translationsData = [
            ['key' => 'welcome', 'locale' => 'ru', 'translation' => 'Я говорю по-русски, всё будет сразу понятно!'],
            ['key' => 'welcome1', 'locale' => 'ru', 'translation' => 'Я говорю по-русски, всё будет сразу понятно!'],
            ['key' => 'inteligent', 'locale' => 'ru', 'translation' => 'Мечтаете ли вы о том.\nчто ваш ребенок станет\nумным?'],
            ['key' => 'inteligent-p', 'locale' => 'ru', 'translation' => 'Концепция школьного и дошкольного образования состоит из 3 программ развития и обучения в нашей академии, разработанных совместно с институтом детского университета, которые помогут вашим детям изучать предметы наилучшим образом.'],
            ['key' => 'ecole', 'locale' => 'ru', 'translation' => 'школа'],
            ['key' => 'cours', 'locale' => 'ru', 'translation' => 'занятия'],
            ['key' => 'boutique', 'locale' => 'ru', 'translation' => 'магазин'],
            ['key' => 'ecole1', 'locale' => 'ru', 'translation' => 'Изучайте французский язык легко с нашим интерактивным и практическим курсом, подходящим для всех уровней. Присоединяйтесь к нам!'],
            ['key' => 'cours1', 'locale' => 'ru', 'translation' => 'Изучайте французский язык легко с нашим интерактивным и практическим курсом, подходящим для всех уровней. Присоединяйтесь к нам!'],
            ['key' => 'boutique1', 'locale' => 'ru', 'translation' => 'Изучайте французский язык легко с нашим интерактивным и практическим курсом, подходящим для всех уровней. Присоединяйтесь к нам!'],
        ];

        foreach ($translationsData as $data) {
            $translation = new Translation();
            $translation->setTranslationKey($data['key'])
                        ->setLocale($data['locale'])
                        ->setTranslation($data['translation']);
            
            $manager->persist($translation);
        }

        $manager->flush();
    }
}
