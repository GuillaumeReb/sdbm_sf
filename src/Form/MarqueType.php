<?php

namespace App\Form;

use App\Entity\Fabricant;
use App\Entity\Marque;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class MarqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomMarque', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom de la marque',
                'label_attr' => ['class' => 'form-label']
            ])

            ->add('pays', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'NomPays',
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom du pays',
                'label_attr' => ['class' => 'form-label'],
                // Permet de mettre le combo en ordre alphabétique
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('pays')
                        ->orderBy('pays.nomPays', 'ASC');
                },
            ])
            ->add('fabricants', EntityType::class, [
                'class' => Fabricant::class,
                'choice_label' => 'nomFabricant',
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom du fabricant',
                'label_attr' => ['class' => 'form-label'],
                // Permet de mettre le combo en ordre alphabétique
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('fabricants')
                        ->orderBy('fabricants.nomFabricant', 'ASC');
                },

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Marque::class,
        ]);
    }
}
