<?php

namespace App\Form;

use App\Entity\Continent;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class PaysType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPays', TextType::class, [
                'attr'=>['class'=> 'form-control'],
                'label' => 'Nom du Pays',
                'label_attr' => ['class' => 'form-label']
            ])
            // ->add('continents', EntityType::class, [
            //     'class' => Continent::class,
            //     'choice_label' => 'id',
            // ])
            ->add('continents', EntityType::class,[
                'class' => Continent::class,
                'choice_label' => 'nom',
                'attr'=>['class'=> 'form-control'],
                // Permet de mettre le combo en ordre alphabétique
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('continent')
                        ->orderBy('continent.nom', 'ASC');
                },
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pays::class,
        ]);
    }
}
