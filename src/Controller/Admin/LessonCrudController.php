<?php

namespace App\Controller\Admin;

use App\Entity\Lesson;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LessonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lesson::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('titre'),
            SlugField::new('slug')->setTargetFieldName('titre'),
            TextEditorField::new('description')
            ->setNumOfRows(15) // Définit la hauteur de l'éditeur
            ->setFormTypeOptions([
                'attr' => [
                    'class' => 'custom-editor',
                    'data-default-content' => '
                        <div class="classes-details" id="article-block">
                            <div class="class-media">
                                <img src="images/blog/large/pic1.jpg" alt=""/>
                            </div>
                            <div class="class-info">
                                <h2 class="post-title">Titre de l\'article</h2>
                                <p class="dlab-post-text">Votre contenu ici...</p>
                            </div>
                        </div>
                    ',
                ],
            ]),

            AssociationField::new('Categories'),
            ChoiceField::new('lang')
                ->setChoices([
                    'Anglais' => 'en',
                    'russe' => 'ru',
                    'bulgare' => 'bg',
                    'allemand' => 'de',
                    'portugais' => 'pt',
                ]
            )

        ];
    }
}
