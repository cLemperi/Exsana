<?php

namespace App\Controller;

use App\Entity\Formations;
use App\Entity\User;
use App\Entity\UserInvite;
use App\Entity\FormContact;
use App\Entity\UserMessage;
use App\Form\UserMessageType;
use App\Form\FormationRegisterType;
use App\Repository\CategoryRepository;
use App\Form\Type\specifiqueFormContact;
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
        $formations = $repo->findBy([],['created_at' => 'desc'],3,1);
        return $this->render('exsana/index.html.twig', [
            'formations' => $formations,
            'controller_name' => 'ExanaHomeController',
        ]);
    }

    #[Route(path: '/exsana/contact', name: 'contact')]
    public function contact(Request $request) : Response
    {
        
        $user = $this->getUser();
        
        if (isset($user)){
            $user = $this->getUser();
            $formcontact = new UserMessage();
            $formcontact->setUserMessage($user);
            $form = $this->createForm(UserMessageType::class, $formcontact);
          }
        else{
            $formcontact = new FormContact();         
            $form = $this->createForm(specifiqueFormContact::class, $formcontact);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($formcontact);
            $this->em->flush();
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
    public function showFormation(FormationsRepository $repo, $id, Request $request) : Response
    {
        $formation = $repo->find($id);
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
        if(isset($user)){
            $form = $this->createForm(FormationRegisterType::class,$user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $user->addFormationregisterid($formation);
                $this->em->persist($user);
                $this->em->flush();
                return $this->redirectToRoute('app_registration_formation');
            }
            $formCreated= $form->createView();
        }
        else {
            $formCreated = "<div class='cadre_acces_compte inscription'>
            <p class='txt'> Vous souhaitez vous inscrire à une formation</p>
            <div class='form-group'>
            <p class='titre'>Créez votre compte</p>
            <form action='{{ path('app_register' )}}' method:'post'>
                <input type='hidden' name='_csrf_token' value='{{ csrf_token('authenticate') }}'>
            </div>
                <button type='submit' class='btn btn-primary' value ='Continuer'> valider</button>
            </form>
        </div>";
        }
        
            

        
        return $this->render('exsana/formation.html.twig', [
      			'controller_name' => 'ExanaHomeController',
                  'formation' => $formation,
                  'formRegister'=> $formCreated,
              ]);
    }
}
