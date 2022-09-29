<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Formations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title')
            ->add('dateFormation',DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                /*'attr'   => [
                    'min' => (new \DateTime())->format('Y-m-d H:i'),
                ],*/
                'model_timezone' => 'Europe/Paris',
                'view_timezone' => 'Europe/Paris',
            ])
            ->add('price')
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'title'
            ])
            ->add('programmeFormations', CollectionType::class,[
                'entry_type' => ProgrammeType::class,
                'entry_options'=> ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true, 
            ])
            ->add('objectifFormations', CollectionType::class,[
                'entry_type' => ObjectifType::class,
                'entry_options'=> ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true, 
            ])
            ->add('duration') //Durée
            ->add('forWho')
            ->add('prerequisite')
            ->add('location')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formations::class,
        ]);
    }
}
