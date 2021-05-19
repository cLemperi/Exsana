<?php

namespace App\Form;

use App\Entity\Formations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('Date')
            ->add('price')
            ->add('duration')
            ->add('objectifFormation')
            ->add('programmeFormmation')
            ->add('forWho')
            ->add('prerequisite')
            ->add('dateAdd')
            ->add('dateFormation')
            ->add('durationFormation')
            ->add('location')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formations::class,
        ]);
    }
}
