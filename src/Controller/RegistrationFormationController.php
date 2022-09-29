<?php

namespace App\Controller;

use App\Entity\Formations;
use App\Form\UserType;
use App\Entity\UserInvite;
use App\Form\UserInviteType;
use App\Form\FormationInviteType;
use App\Form\FormationRegisterType;
use App\Repository\UserInviteRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegistrationFormationController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    
    #[Route('/registration/formation', name: 'app_registration_formation')]
    #[Entity('user', options: ['id' => 'user'])]
    public function index(UserRepository $repo): Response
    {  
        /**
            * @var Entity::User
        */
        $user= $this->getUser();
        $userInvite = $user->getUserInvites();
        //$test = var_dump($userInvite);
        return $this->render('registration_formation/index.html.twig', [
            "userInvites" => $userInvite,
        ]);
    }

    #[Route('/registration/update', name: 'registration_update')]
    public function readUserInvite(Request $request): Response
    {   
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /**
            * @var Entity::User
        */
        $user = $this->getUser();
       
        $form = $this->createForm(FormationInviteType::class, $user)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            return $this->redirectToRoute('formation.inscription');
        }
        
        return $this->render('registration_formation/update.html.twig', [
            'controller_name' => 'RegistrationFormationController',
            "form" => $form->createView()
        ]);
    }

    #[Route('/registration/create', name: 'registration_add_invite')]
    public function addUserInvite(Request $request): Response
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
       /**
            * @var Entity::User
        */
        $user = $this->getUser();
        $userInvite = new UserInvite();
        //$user->addUserInvite($userInvite);
        
        $form = $this->createForm(FormationInviteType::class,$user)->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $user->addFormationregisterid();
                $this->em->persist($user);
                $this->em->flush();
                return $this->redirectToRoute('formation.inscription');
            }
        
        return $this->render('registration_formation/create.html.twig', [
            'controller_name' => 'RegistrationFormationController',
            'form'=> $form->createView()
        ]);
    }

    #[Route('/registration/inscription', name: 'formation.inscription')]
    public function inscriptionUserFormation(Request $request): Response
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
       /**
            * @var Entity::User
        */
        $user = $this->getUser();
        $userInvite = $user->getUserInvites();
        
        $form = $this->createForm(FormationInviteType::class,$user)->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->em->persist($user);
                $this->em->flush();
                return $this->redirectToRoute('formation.inscription');
            }
        
        return $this->render('registration_formation/create.html.twig', [
            'controller_name' => 'RegistrationFormationController',
            'form'=> $form->createView()
        ]);
    }

    
}
