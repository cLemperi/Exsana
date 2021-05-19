<?php

namespace App\Controller\Admin;
use App\Entity\Formations;
use App\Form\FormationType;
use App\Repository\FormationsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFormationController extends AbstractController
{   
    /**
     * @var FormationsRepository
     */
    private $repository;
    
    public function __construct(FormationsRepository $repository)
    {
        //$this->em = $em;
        $this->repository = $repository;
    }
    
    /**
     * @Route("/admin/gestion", name="admin_admin_gestion")
     */
    public function index(): Response
    {
        $formations =  $this->repository->findAll();
        return $this->render('admin/formation/index.html.twig', [
            'controller_name' => 'AdminFormationController',
            'formations' => $formations
        ]);
    }
    
    /**
     * @Route("/admin/formation/create", name="admin.formation.new")
     */
    public function new(Request $request)
    {
        $formation = new Formations();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            //$this->em->persist($formation);
            //$this->em->flush();
            //$this->addFlash('success', 'Bien ajouté avec succès');
            return $this->redirectToRoute('admin.formation.index');
        }

        return $this->render('admin/formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/admin/formation/{id}", name="admin.formation.edit", methods="GET|POST")
     * @param Formations $formation
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Formations $formation, Request $request)
    {
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            //$this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.formation.index');
        }

        return $this->render('admin/formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/formation/{id}", name="admin.formation.delete", methods="DELETE")
     * @param Formations $formation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Formations $formation, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $formation->getId(), $request->get('_token'))) {
            //$this->em->remove($formation);
            //$this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }
        
        return $this->redirectToRoute('admin_admin_gestion');
    }

}
