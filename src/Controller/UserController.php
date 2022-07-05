<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    //menu du profils
    #[Route('/user/index', name: 'user.index')]
    public function myAccount(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    //modifier son compte
    #[Route('/user/mon_compte', name: 'user.register')]
    public function userRegister(): Response
    {
        return $this->render('user/userRegister.html.twig', [
            'controller_name' => 'UserController',
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
}
