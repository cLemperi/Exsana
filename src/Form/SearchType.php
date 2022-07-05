<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class,[
                'label' => false,
                'required' => false,
                
            ])
            ->add('category',EntityType::class,[
                'label' => false,
                'required' => false,
                'class' => Category::class,
                'expanded' => true,
                'multiple' => true
            ])
            ;
    }
    function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    function getBlockPrefix():string
    {
        return '';
    }


}