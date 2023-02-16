<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom',TypeTextType::class, [
                'attr' => [
                    'class'=>'form-invite'
                ]
            ])
            ->add('nom',TypeTextType::class, [
                'attr' => [
                    'class'=>'form-invite'
                ]
            ])
            ->add('profession',TypeTextType::class, [
                'attr' => [
                    'class'=>'form-invite'
                ]
            ])
            ->add('email',EmailType::class, [
                'attr' => [
                    'class'=>'form-invite'
                ]
            ])
            ->add('relation');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
