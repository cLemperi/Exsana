<?php

namespace App\Form;

use App\Entity\UserMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('request',ChoiceType::class,[
            'choices'=> [
                'Organiser une formation en intra / sur mesure' => 'Organiser une formation en intra / sur mesure',
                'Obtenir des renseignements sur nos programmes inter' => 'Obtenir des renseignements sur nos programmes inter',
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
