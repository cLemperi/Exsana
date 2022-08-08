<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils) : \Symfony\Component\HttpFoundation\Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastusername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig',[
            'last_username' => $lastusername,
            'error' => $error
        ]);
    }
}
