<?php

namespace App\Form;

use App\Entity\Continent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContinentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // ici pour modifier avec du bootstrap
            ->add('nom', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom du Continent',
                'label_attr' => ['class' => 'form-label']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Continent::class,
        ]);
    }
}
