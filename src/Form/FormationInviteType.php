<?php

namespace App\Form;

use App\Entity\Formations;
use App\Entity\User;
use App\Entity\UserInvite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FormationInviteType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('userInvites', CollectionType::class,[
            'entry_type' => UserInviteType::class,
            'entry_options'=> ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
        ])
        ->add('formationregisterid', EntityType::class,[
                'class' => User::class,
                'choice_label' => 'formationregisterid',
                'mapped' => false
        ]);
        // $builder
        // ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
        //     $user = getUser();
        //     /** @var \App\Entity\User $user */
        //     $userInvite = $event->getData();
        //     $form = $event->getForm();
    
        //     // checks if the Product object is "new"
        //     // If no data is passed to the form, the data is "null".
        //     // This should be considered a new "Product"
        //     if (!$userInvite || null === $userInvite->getId()) {
        //     $form->add('nickname',TypeTextType::class);
        //     $form->add('lastname',null, array('label' => false));
        //     $form->add('profession',null, array('label' => false));
        //     $form->add('email', EmailType::class);
        //     }
        // });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
