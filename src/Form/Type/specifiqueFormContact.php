<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class specifiqueFormContact extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        	$builder
                    ->add('sex',TextType::class)
                    ->add('nickname',TextType::class)
                    ->add('lastname',TextType::class)
                    ->add('phone',NumberType::class)
                    ->add('email',EmailType::class)
                    ->add('profession',TextType::class)
                    ->add('etablissement',TextType::class)
                    ->add('adresse',TextType::class)
                    ->add('city',TextType::class)
                    ->add('postalCode',NumberType::class)
                    ->add('request',TextType::class)
                    ->add('message',TextType::class)
                    ->add('save', SubmitType::class, ['label' => 'Create Task']);
    }
}
