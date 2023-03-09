<?php

namespace App\Controller;

use App\Entity\Curiculum;
use App\Form\CuriculumType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CurriculumController extends AbstractController
{
    #[Route('/curriculum', name: 'app_curriculum')]
    public function index(): Response
    {
        return $this->render('curriculum/index.html.twig', [
            'controller_name' => 'CurriculumController',
        ]);
    }


    #[Route('/recrutement', name: 'recrutement')]
    public function recrutement(Request $request): Response
    {
        $curiculum = new Curiculum();
        $form = $this->createForm(CuriculumType::class, $curiculum);
        $form->handleRequest($request);


        //je vais devoir faire la verification de mail ici avant l'envoi du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $this->em->persist($curiculum);
            $this->em->flush();
            $this->addFlash('success', 'Votre Cv à bien était transmit');
            return $this->redirectToRoute('home');
            // do anything else you need here, like send an email
        }

        return $this->render('curriculum/create.html.twig', [
            'controller_name' => 'CurriculumController',
            'form' => $form->createView(),
        ]);
    }
}
