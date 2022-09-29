<?php

namespace App\Form;

use App\Entity\Formations;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FormationRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           // ->add('UserRegisterFormation',EntityType::class,[
           //     'class' => User::class,
           // ])
            ->add('nbUserInvite',ChoiceType::class,[
                'choices'=> [
                        '1'=> 1,
                        '2'=> 2,
                        '3'=>3,
                        '4'=>4,
                        '5'=>5,
                        '6'=>6,
                        '7'=>7,
                        '8'=>8,
                        '9'=>9,
                        '10'=>10,
                        '11'=>11                
                        ],
                ]
            );
                
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
