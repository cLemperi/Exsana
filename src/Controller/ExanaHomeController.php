<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Formations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FormationsRepository;
use App\Entity\FormContact;
use App\Entity\User;
use App\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Type\specifiqueFormContact;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;

class ExanaHomeController extends AbstractController
{
    #[Route(path: '/', name: 'exana_home')]
    public function index(FormationsRepository $repo) : Response
    {
        $formations = $repo->findBy([],['created_at' => 'desc'],3,1);
        return $this->render('exsana/index.html.twig', [
            'formations' => $formations,
            'controller_name' => 'ExanaHomeController',
        ]);
    }

    #[Route(path: '/exsana/contact', name: 'contact')]
    public function contact(Request $request, EntityManagerInterface $em) : Response
    {
        $formcontact = new FormContact();
        $user = $this->getUser();
        /*if (isset($user)){
              $form = $this->createForm(specifiqueFormContact::class, $user);
          }
          else{
              $form = $this->createForm(specifiqueFormContact::class, $formcontact);
          }*/
        $form = $this->createForm(specifiqueFormContact::class, $formcontact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->$em->persist();
            $this->$em->flush();
            $this->addFlash('success', 'Votre demande de contact à bien été envoyé à notre équipe');
            return $this->redirectToRoute('contact');
}
        return $this->render('exsana/contact.html.twig', [
                'formFormation' => $form->createView(),
            ]);
    }

    #[Route(path: '/exsana/qui-somme-nous', name: 'whoweare')]
    public function whoweare() : \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('exsana/whoweare.html.twig', [
               'controller_name' => 'ExanaHomeController',
           ]);
    }
    #[Route(path: '/exsana/pratique', name: 'whereweare')]
    public function pratique() : \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('exsana/pratique.html.twig', [
               'controller_name' => 'ExanaHomeController',
           ]);
    }

    #[Route(path: '/exsana/informations', name: 'info')]
    public function infoexana() : \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('exsana/information.html.twig', [
               'controller_name' => 'ExanaHomeController',
           ]);
    }

    #[Route(path: '/exsana/formations', name: 'formations')]
    public function exsenaFormations(CategoryRepository $cate, Request $request, FormationsRepository $repo, PaginatorInterface $paginator) : \Symfony\Component\HttpFoundation\Response
    {
        //Trouve toutes les formations
        //Création du formulaire de recherche
        //bar de recherche à terminer
        /*
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        */
        $listFormation = $repo->findAll();
        $listCategory = $cate->findAll();
        $formations = $paginator->paginate(
             $listFormation,
             $request->query->getInt('page', 1), 6);
        //$lastFormation = $repo->findBy([],['created_at' => 'desc']);
        return $this->render('exsana/formations.html.twig', [
               'formations' => $formations,
               'category' => $listCategory,
               //'form' => $form->createView(),
               //'lastformation' =>$lastFormation
           ]);
    }

    #[Route(path: 'exsana/formation{id}', name: 'formation')]
    public function showFormation(FormationsRepository $repo, $id) : Response
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
