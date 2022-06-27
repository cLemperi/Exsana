<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Formations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FormationsRepository;
use App\Entity\FormContact;
use App\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Type\specifiqueFormContact;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;

class ExanaHomeController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        //em entity manager
        $this->em = $em;
    }


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
    public function exsenaFormations(CategoryRepository $cate, Request $request, FormationsRepository $repo)  {
    	//Trouve toutes les formations
        
       //Création du formulaire de recherche
        $data = new SearchData();
        
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
         // effectuer un système de pagination
        //$formations = $paginator->paginate(
           // $listFormation,
            //$request->query->getInt('page', 1), 8);
        //dd($formations);
        $listFormation = $repo->findSearch($data);
        $listCategory = $cate->findAll();

        //$lastFormation = $repo->findBy([],['created_at' => 'desc']);

    	return $this->render('exana/formations.html.twig', [
            'formations' => $listFormation,
            'category' => $listCategory,
            'form' => $form->createView()
            //'lastformation' =>$lastFormation
        ]);
    }

    /**
     * @Route("exsana/formation{id}", name="formation")
     */
    public function showFormation(FormationsRepository $repo, $id): Response
    {
    	$formation = $repo->find($id);
    	if(!$formation){
            // Si aucune formation n'est trouvé, nous créons une exception
            throw $this->createNotFoundException('La formation n\'existe pas');
        }

		return $this->render('exana/formation.html.twig', [
			'controller_name' => 'ExanaHomeController',
            'formation' => $formation,
        ]);
    }
}
