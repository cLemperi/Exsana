<?php

namespace App\Form;

use App\Entity\UserInvite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;

class UserInviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nickname',TypeTextType::class, [
                'attr' => [
                    'class'=>'form-invite',
                ]
            ])
            ->add('lastname',TypeTextType::class, [
                'attr' => [
                    'class'=>'form-invite'
                ]
            ])
            ->add('profession',TypeTextType::class, [
                'attr' => [
                    'class'=>'form-invite'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class'=>'form-invite'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserInvite::class,
        ]);
    }
}
