<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Couleur;
use App\Entity\Marque;
use App\Entity\Typebiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomArticle', TextType::class, [
                'attr'=>['class'=> 'form-control'],
                'label' => 'Nom de l\'article',
                'label_attr' => ['class' => 'form-label']
            ])
            ->add('prixAchat', TextType::class, [
                'attr'=>['class'=> 'form-control'],
                'label' => 'Prix d\'achat',
                'label_attr' => ['class' => 'form-label']
            ])
            ->add('volume', TextType::class, [
                'attr'=>['class'=> 'form-control'],
                'label' => 'Volume',
                'label_attr' => ['class' => 'form-label']
            ])
            ->add('titrage', TextType::class, [
                'attr'=>['class'=> 'form-control'],
                'label' => 'Titrage',
                'label_attr' => ['class' => 'form-label']
            ])
            ->add('marques', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => 'nomMarque',
                'attr'=>['class'=> 'form-control'],
                // Permet de mettre le combo en ordre alphabétique
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('marque')
                        ->orderBy('marque.nomMarque', 'ASC');
                },
            ])
            ->add('couleurs', EntityType::class, [
                'class' => Couleur::class,
                'choice_label' => 'nomCouleur',
                'attr'=>['class'=> 'form-control'],
                // Permet de mettre le combo en ordre alphabétique
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('couleur')
                        ->orderBy('couleur.nomCouleur', 'ASC');
                },
            ])
            ->add('types', EntityType::class, [
                'class' => Typebiere::class,
                'choice_label' => 'nomType',
                'attr'=>['class'=> 'form-control'],
                // Permet de mettre le combo en ordre alphabétique
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('type')
                        ->orderBy('type.nomType', 'ASC');
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
