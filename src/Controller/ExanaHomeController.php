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
    public function index(FormationsRepository $repo): Response
    {
        $formations = $repo->findBy(array(),array('id'=>'DESC'),3,1);

        return $this->render('exsana/index.html.twig', [
            'formations' => $formations,
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
        

        return $this->render('exsana/contact.html.twig', [
                'formFormation' => $form->createView()
            ]);
    }

    /**
     * @Route("/exsana/qui-somme-nous", name="whoweare")
     */
    public function whoweare() {
    	return $this->render('exsana/whoweare.html.twig', [
            'controller_name' => 'ExanaHomeController',
        ]);
    }
    /**
     * @Route("/exsana/pratique", name="whereweare")
     */
    public function pratique()  {
    	return $this->render('exsana/pratique.html.twig', [
            'controller_name' => 'ExanaHomeController',
        ]);
    }

    /**
     * @Route("/exsana/informations", name="info")
     */
    public function infoexana()  {
    	return $this->render('exsana/information.html.twig', [
            'controller_name' => 'ExanaHomeController',
        ]);
    }

    /**
     * @Route("/exsana/formations", name="formations")
     */
    public function exsenaFormations(CategoryRepository $cate, Request $request, FormationsRepository $repo,PaginatorInterface $paginator)  {
    	//Trouve toutes les formations
        
       //Création du formulaire de recherche
        $data = new SearchData();

       
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $listFormation = $repo->findSearch($data);
        $listCategory = $cate->findAll();

        $formations = $paginator->paginate(
             $listFormation,
             $request->query->getInt('page', 1), 6);
        ($formations);

        //$lastFormation = $repo->findBy([],['created_at' => 'desc']);

    	return $this->render('exsana/formations.html.twig', [
            'formations' => $formations,
            'category' => $listCategory,
            'form' => $form->createView(),
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

		return $this->render('exsana/formation.html.twig', [
			'controller_name' => 'ExanaHomeController',
            'formation' => $formation,
        ]);
    }
}
