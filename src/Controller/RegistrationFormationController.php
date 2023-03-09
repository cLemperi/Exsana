<?php

namespace App\Controller;

use App\Entity\Formations;
use App\Form\FormationInviteType;
use App\Form\FormationRegistrationType;
<<<<<<< HEAD
=======
use App\Repository\UserInviteRepository;
use App\Service\UserRegistrationService;
use App\Service\UserRegistrationServiceInterface;
>>>>>>> Mailer
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/registration/formation/{id}', name: 'add_participant')]
    public function inscription(
        Formations $formation, Request $request,UserRegistrationServiceInterface $mail): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        // Vérifier si l'utilisateur a déjà été ajouté à la formation
        if ($formation->getUsers()->contains($user)) {
            $this->addFlash('error', 'Vous êtes déjà inscrit à cette formation.');
            return $this->redirectToRoute('formations');
        }
        $participants = $user->getParticipants();
        $form = $this->createForm(FormationRegistrationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formation->addUser($user);
<<<<<<< HEAD
            $this->em->persist($formation);
            $this->em->flush();

            $this->addFlash('success', 'Inscription à la formation réussie!');
            $this->addFlash('formation_id', $formation->getId());

            return $this->redirectToRoute('formations');
=======
            try {
                $this->em->persist($formation);
                $this->em->flush();
                // Rediriger vers la liste des formations avec un message de confirmation
                $this->addFlash('success', 'Inscription à la formation réussie!');
                return $this->redirectToRoute('formations');
            } catch (\Exception $e) {
                // Afficher un message d'erreur en cas d'erreur de persistance
                $this->addFlash('error', 'Une erreur est survenue lors de l\'inscription à la formation.');
                // Enregistrer l'exception dans les logs pour un débogage ultérieur
                $this->logger->error('Error during formation registration', ['exception' => $e]);
            }
>>>>>>> Mailer
        }

        $mail->sendRegistrationFormationEmail($usermail = $user->getEmail(), $formationTitle = $formation->getTitle());

    return $this->render('registration_formation/index.html.twig', [
        'participants' => $participants,
        'formation' => $formation,
        'form' => $form->createView(),
    ]);
}

    #[Route('/registration/create/{id}', name: 'registration_add_invite')]
    public function addUserInvite(Request $request,int $id): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $formation = $this->em->getRepository(Formations::class)->find($id);
        if (!$formation) {
            throw $this->createNotFoundException('Formation non trouvée');
        }
        
        /**
         * @var Entity::User
         */
        $user = $this->getUser();

        $form = $this->createForm(FormationInviteType::class, $user)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', "L'inscrinscription à la formation à bien était validé");
            return $this->redirectToRoute('registration_add_invite', ['id' => $id]);
        }

        return $this->render('registration_formation/create.html.twig', [
            'formation' => $formation,
            'controller_name' => 'RegistrationFormationController',
            'form' => $form->createView(),
        ]);
    }
}
