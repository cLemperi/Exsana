<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfilsType;
use App\Repository\FormationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user'), IsGranted('ROLE_USER')]
class UserController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    #[Route('/mon_compte', name: 'user.register', methods: ['GET|POST'])]
    public function userRegister(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
                return $this->redirectToRoute('exana_home');
            }
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
    public function userFormation(FormationsRepository $repo): Response
    {

        $user = $this->getUser();
        if (!$user instanceof User) {
        // Gérer le cas où l'utilisateur n'est pas connecté
            return $this->redirectToRoute('exana_home');
        }

        $formations = $repo->findByUser($user);



        //$formationIdUser = $formations->getUserRegisterFormation();
        //var_dump($formationIdUser);
        return $this->render('user/userFormations.html.twig', [
            'formations' => $formations,
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
