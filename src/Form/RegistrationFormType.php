<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Pseudo'
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'options' => [
                    'attr' => ['autocomplete' => 'new-password'],
                ],
                'first_options'  => [
                    'label' => 'Mot de passe',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            'max' => 4096,
                        ]),
                    ],
                ],
                'second_options' => ['label' => 'Confirmez le mot de passe'],
                'invalid_message' => 'Les mots de passe doivent correspondre.',
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'Mr' => 'Mr',
                    'Mme' => 'Mme',
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Civilité'
            ])
            ->add('firstName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'autocomplete' => 'given-name'   // Add this line for first name autocomplete
                ],
                'label' => 'Prénom'
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'autocomplete' => 'family-name'   // Add this line for last name autocomplete
                ],
                'label' => 'Nom'
            ])
            ->add('email', EmailType::class, [
                'attr' => ['autocomplete' => 'email']
            ])
            ->add('job', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Emploi'
            ])
            ->add('phone', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'autocomplete' => 'tel'   // Add this line for phone autocomplete
                ],
                'label' => 'Téléphone'
            ])
            ->add('rppsCode', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Code RPPS'
            ])
            ->add('postalCode', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'autocomplete' => 'postal-code'   // Add this line for postal code autocomplete
                ],
                'label' => 'Code postal'
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'autocomplete' => 'address-level2'   // Add this line for city autocomplete
                ],
                'label' => 'Ville'
            ])
            ->add('street', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'autocomplete' => 'address-line1'   // Add this line for street address autocomplete
                ],
                'label' => 'Rue'
            ])
    
            ->add('profil', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
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
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'homepage',
                'locale' => 'fr',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
