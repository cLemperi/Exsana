<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\Formations;
use App\Entity\UserInvite;
use App\Form\UserInviteType;
use Doctrine\ORM\Mapping\Entity;
use App\Form\FormationInviteType;
use App\Repository\UserRepository;
use App\Form\FormationRegisterType;
use App\Repository\UserInviteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class RegistrationFormationController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    
    #[Route('/registration/formation{id}', name: 'app_registration_formation')]
    #[Entity('user', options: ['user' => 'id'])]
    public function index(Formations $formations, Request $request): Response
    {  
        $formation = $formations;
        /**
            * @var Entity::User
        */
        $user= $this->getUser();
        $userInvite = $user->getUserInvites();
        //$test = var_dump($userInvite);
        return $this->render('registration_formation/index.html.twig', [
            "userInvites" => $userInvite,
            "user" => $user,
            "formation" => $formation
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
       
        $form = $this->createForm(UserInviteType::class, $user)->handleRequest($request);
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
    public function addUserInvite(Request $request,): Response
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
                $this->em->persist($user);
                $this->em->flush();
                $this->addFlash('success', "L'inscrinscription à la formation à bien était validé");
                return $this->redirectToRoute('registration_add_invite');
            }
        
        return $this->render('registration_formation/create.html.twig', [
            'controller_name' => 'RegistrationFormationController',
            'form'=> $form->createView(),
        ]);
    }

    #[Route('/registration/inscription{id}', name: 'formation.inscription')]
    public function inscriptionUserFormation(Request $request, Formations $formations): Response
    {   

        $formation = $formations;
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
                $this->addFlash('success', "L'inscrinscription à la formation à bien était validé");
                return $this->redirectToRoute('formation.inscription');
            }
        
        return $this->render('registration_formation/create.html.twig', [
            'controller_name' => 'RegistrationFormationController',
            'form'=> $form->createView(),
            'formation' => $formations
        ]);
    }

    
}
