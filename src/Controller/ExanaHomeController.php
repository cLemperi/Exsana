<?php

namespace App\Controller;


use App\Entity\FormContact;
use App\Entity\UserMessage;
use App\Form\UserMessageType;
use App\Form\FormationRegisterType;
use App\Form\SpecifiqueFormContact;
use App\Repository\CategoryRepository;
use App\Repository\FormationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExanaHomeController extends AbstractController
{
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    #[Route(path: '/', name: 'exana_home')]
    public function index(FormationsRepository $repo) : Response
    {
        $formations = $repo->findBy([],['created_at' => 'desc'],4,1);
        return $this->render('exsana/index.html.twig', [
            'formations' => $formations,
            'controller_name' => 'ExanaHomeController',
        ]);
    }

    #[Route(path: '/exsana/contact', name: 'contact')]
    public function contact(Request $request): Response
    {
        $user = $this->getUser();
        $formContact = null;
        $form = null;

        if ($user) {
            $formContact = new UserMessage();
            $formContact->setUserMessage($user);
            $form = $this->createForm(UserMessageType::class, $formContact);
        } else {
            $formContact = new FormContact();
            $form = $this->createForm(SpecifiqueFormContact::class, $formContact)->handleRequest($request);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($formContact);
            $this->em->flush();
            $this->addFlash('success', 'Votre demande de contact a bien été envoyée à notre équipe.');
            return $this->redirectToRoute('contact');
        }

        return $this->render('exsana/contact.html.twig', [
            'formContact' => $form->createView(),
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

    #[Route(path: '/exsana/mentions-legales', name: 'mention')]
    public function mentionslegales() : \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('exsana/mentions-legales.html.twig', [
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

    #[Route(path: 'exsana/formation/{id}{slug}', name: 'formation')]
    public function showFormation(FormationsRepository $repo, $id, Request $request) : Response
    {
        $formation = $repo->find($id);
        $programmePedagoFile = $formation->getProgrammePedagoFile();
        //$formaId = $this->$forma->getId(); 
        /**
            * @var Entity::User
        */
        $user = $this->getUser();
        if(isset($user)){
            $currentUser= $user->getId();
        }
        if(!$formation){
               // Si aucune formation n'est trouvé, nous créons une exception
               throw $this->createNotFoundException('La formation n\'existe pas');
           }
        return $this->render('exsana/formation.html.twig', [
                'programmePedagoFile' => $programmePedagoFile,
      			'controller_name' => 'ExanaHomeController',
                  'formation' => $formation,
              ]);
    }
}
