<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FormationsRepository;
use App\Entity\FormContact;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Type\specifiqueFormContact;

class ExanaHomeController extends AbstractController
{
    /**
     * @Route("/", name="exana_home")
     */
    public function index(): Response
    {
        return $this->render('exana/index.html.twig', [
            'controller_name' => 'ExanaHomeController',
        ]);
    }

    /**
     * @Route("/exsana/contact", name="contact")
     */
    public function contact(Request $request,EntityManagerInterface $manager): Response {
        $formcontact = new FormContact(); 
        $form = $this->createForm(specifiqueFormContact::class, $formcontact);
        $form->handleRequest($request);
        

        return $this->render('exana/contact.html.twig', [
                'formFormation' => $form->createView()
            ]);
    }

    /**
     * @Route("/exsana/qui-somme-nous", name="whoweare")
     */
    public function whoweare() {
    	return $this->render('exana/whoweare.html.twig', [
            'controller_name' => 'ExanaHomeController',
        ]);
    }
    /**
     * @Route("/exsana/pratique", name="whereweare")
     */
    public function pratique()  {
    	return $this->render('exana/pratique.html.twig', [
            'controller_name' => 'ExanaHomeController',
        ]);
    }

    /**
     * @Route("/exsana/informations", name="info")
     */
    public function infoexana()  {
    	return $this->render('exana/information.html.twig', [
            'controller_name' => 'ExanaHomeController',
        ]);
    }

    /**
     * @Route("/exsana/formations", name="formations")
     */
    public function exsenaFormations(FormationsRepository $repo)  {
    	//Trouve toutes les formations
        // effectuer un système de pagination
    	$listFormation = $repo->findAll();

    	return $this->render('exana/formations.html.twig', [
            'controller_name' => 'ExanaHomeController',
            'formations' => $listFormation
        ]);
    }

    /**
     * @Route("exsana/formation{id}", name="formation")
     */
    public function showFormation(FormationsRepository $repo, $id): Response
    {
    	$formation = $repo->find($id);

    	

		return $this->render('exana/formation.html.twig', [
			'controller_name' => 'ExanaHomeController',
            'formation' => $formation
        ]);
    }

}
