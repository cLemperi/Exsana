<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\UserMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('request', ChoiceType::class, [
            'mapped' => false,
            'choices' => [
                'Organiser une formation en intra / sur mesure' => 'Organiser une formation en intra / sur mesure',
                'Obtenir des renseignements sur nos programmes inter' =>
                    'Obtenir des renseignements sur nos programmes inter',
                'Recrutement' => 'Recrutement',
                "Autre demande d\'information" => "Autre demande d'information"
            ]
            ])
            ->add('title')
            ->add('Content', TextareaType::class, [
                'attr' => ['class' => 'tinymce'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserMessage::class,
        ]);
    }
}
