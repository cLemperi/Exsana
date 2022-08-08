<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\ProfilsType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;





#[Route('/user'), IsGranted('ROLE_USER')]
class UserController extends AbstractController
{
    public function __construct(private UserRepository $repository,EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    
    #[Route('/mon_compte', name: 'user.register', methods: ['GET|POST'])]
    public function userRegister(Request $request, EntityManagerInterface $em): Response
    {   
        $user = $this->getUser();
        $form = $this->createForm(ProfilsType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                    $this->em->persist($user);
                    $this->em->flush();
                    $this->addFlash('success', 'Profils bien modifié avec succès');
                    return $this->redirectToRoute('user.register');
        }
        

        return $this->render('user/userProfils.html.twig', [
            'profil' => $form->createView(),
        ]);
    }

    //les formations utilisisateurs inscrit
    #[Route('/myformations', name: 'user.formations', methods: ['GET|POST'])]
    public function userFormation(): Response
    {

        return $this->render('user/userFormations.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    //aide et assistance
    #[Route('/help', name: 'user.help')]
    public function userHelp(): Response
    {
        return $this->render('user/userHelp.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
