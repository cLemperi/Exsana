<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;
    public function __construct(UserRepository $repository, EntityManagerInterface $em)
    {
        //em entity manager
        $this->em = $em;
        $this->repository = $repository;
    }




    //menu du profils
    #[Route('/user/index', name: 'user.index')]
    public function myAccount(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    //modifier son compte
    /**
     * @param User $user
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    #[Route('/user/mon_compte', name: 'user.register')]
    public function userRegister(User $user, Request $request): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                    $this->em->persist($user);
                    $this->em->flush();
                    $this->addFlash('success', 'Bien modifié avec succès');
                    return $this->redirectToRoute('user/mon_compte');
        }

        return $this->render('userRegister.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //les formations utilisisateurs inscrit
    #[Route('/user/myformations', name: 'user.formations')]
    public function userFormation(): Response
    {
        return $this->render('user/userFormations.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    //aide et assistance
    #[Route('/user/help', name: 'user.help')]
    public function userHelp(): Response
    {
        return $this->render('user/userHelp.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    //creation d'un nouvelle utilisateur
    #[Route('/user/new', name: 'user.new')]
    public function createNewUser(Request $request): Response
    {
        $user = new User;
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                    $this->em->persist($user);
                    $this->em->flush();
                    $this->addFlash('success', 'Vous avez créez votre compte ! Félicitation');
                    return $this->redirectToRoute('/');
        }

        return $this->render('admin/formation/edit.html.twig', [
            'form' => $form->createView()
        ]);
        
        
        return $this->render('user/userHelp.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
