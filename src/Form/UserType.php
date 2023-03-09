<?php

namespace App\Form;

use App\Entity\User;
use App\Form\UserInviteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('password')
            ->add('roles')
            ->add('sex')
            ->add('firstName')
            ->add('lastName')
            ->add('email', EmailType::class)
            ->add('job')
            ->add('phone')
            ->add('rppsCode')
            ->add('postalCode')
            ->add('city')
            ->add('street')
            ->add('profil')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
