<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label' => 'Pseudo'
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'label' => 'Mot de passe'
            ])
            ->add('sex',ChoiceType::class, [
                'choices' => [
                    'Mr' => 'Mr',
                    'Mme' => 'Mme',
                ],
                'attr' => [
                    'class'=>'form-control'
                ],
                'label' => 'Civilité'
            ])
            ->add('firstName',TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label' => 'Prénom'
            ])
            ->add('lastName',TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label' => 'Nom'
            ])
            ->add('email', EmailType::class)
            ->add('job',TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label' => 'Emploi'
            ])
            ->add('phone',TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label' => 'Téléphone'
            ])
            ->add('rppsCode',TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label' => 'Code RPPS'
            ])
            ->add('postalCode',TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label' => 'Code postal'
            ])
            ->add('city',TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label' => 'Ville'
            ])
            ->add('street',TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label' => 'Rue'
            ])
            ->add('profil',TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label' => 'Profils'
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
