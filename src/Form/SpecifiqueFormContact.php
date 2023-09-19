<?php

namespace App\Form;

use App\Entity\FormContact;
use App\Entity\MessageFromContact;
use Symfony\Component\Form\AbstractType;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

class SpecifiqueFormContact extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
            $builder
                    ->add('sex', ChoiceType::class, [
                    'choices' => [
                        'Civilité' => null,
                        'Monsieur' => 'Mr',
                        'Madame' => 'Mme'
                    ]
                   ])
                    ->add('nickname', TextType::class)
                    ->add('lastname', TextType::class)
                    ->add('phone', TextType::class)
                    ->add('email', EmailType::class)
                    ->add('profession', ChoiceType::class, [
                        'choices' => [
                            'Profession' => null,
                            'Agent hospitalier (ASH), personnel technique' =>
                                'Agent hospitalier (ASH),personnel technique',
                            'Aide-soignant' => 'Aide-soignant',
                            'Ambulancier' => 'Ambulancier',
                            'ARM' => 'ARM',
                            'Assistant dentaire' => 'Assistant dentaire',
                            'Auxiliaire de puériculture' => 'Auxiliaire de puériculture',
                            'Brancardier' => 'Brancardier',
                            'Cadre dirigeant' => 'Cadre dirigeant',
                            'Chirurgien-dentiste' => 'Chirurgien-dentiste',
                            'Éducateur spécialisé' => 'Éducateur spécialisé',
                            'Infirmier' => 'Infirmier',
                            'Infirmier anesthésiste' => 'Infirmier anesthésiste',
                            'Infirmier de bloc opératoire' => 'Infirmier de bloc opératoire',
                            'Infirmier libéral' => 'Infirmier libéral',
                            'Infirmier puériculteur' => 'Infirmier puériculteur',
                            'Kinésithérapeute' => 'Kinésithérapeute',
                            'Manipulateur radio' => 'Manipulateur radio',
                            'Médecin' => 'Médecin',
                            'Personnel administratif / Chargé de formation' =>
                                'Personnel administratif / Chargé de formation',
                            'Pharmacien / préparateur en pharmacie' => 'Pharmacien / préparateur en pharmacie',
                            'Psychologue' => 'Psychologue',
                            'Sage-femme' => 'Sage-femme',
                            'Technicien de laboratoire' => 'Technicien de laboratoire'
                        ]
                        ])
                    ->add('etablissement', TextType::class)
                    ->add('city', TextType::class)
                    ->add('adresse', TextType::class)
                    ->add('postalCode', TextType::class)
                    ->add('request', ChoiceType::class, [
                        'choices' => [
                            'Organiser une formation en intra / sur mesure' =>
                                'Organiser une formation en intra / sur mesure',
                            'Obtenir des renseignements sur nos programmes inter' =>
                                'Obtenir des renseignements sur nos programmes inter',
                            'Recrutement' =>
                                'Recrutement',
                            "Autre demande d\'information" =>
                                "Autre demande d'information"
                        ]
                        ])
                    ->add('message', TextareaType::class)
                    ->add('captcha', Recaptcha3Type::class, [
                        'constraints' => new Recaptcha3(),
                        'action_name' => 'homepage',
                        'locale' => 'fr',
                    ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormContact::class,
        ]);
    }
}
