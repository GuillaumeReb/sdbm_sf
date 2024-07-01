<?php

namespace App\Form;

use App\Entity\Fabricant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FabricantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // ici pour modifier avec du bootstrap
            ->add('nomFabricant', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom du Fabricant',
                'label_attr' => ['class' => 'form-label']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fabricant::class,
        ]);
    }
}
