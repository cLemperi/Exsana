<?php

namespace App\Controller\Admin;

use App\Entity\Formations;
use App\Form\FormationType;
use App\Repository\FormationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AdminFormationController extends AbstractController
{
    private EntityManagerInterface $em;
    private FormationsRepository $repository;

    public function __construct(EntityManagerInterface $em, FormationsRepository $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
    }


    #[Route(path: '/admin/index', name: 'admin.index')]
    public function index(): Response
    {
        return $this->render('admin/formation/formation/index.html.twig', [
            'controller_name' => 'AdminFormationController'
        ]);
    }

    #[Route(path: '/admin/formation/formation/gestion', name: 'admin.formation.index')]
    public function gestionFormation(): Response
    {
        $formations =  $this->repository->findAll();
        return $this->render('admin/formation/formation/gestion.html.twig', [
            'controller_name' => 'AdminFormationController',
            'formations' => $formations
        ]);
    }

    #[Route(path: '/admin/formation/create', name: 'admin.formation.new')]
    public function new(Request $request): Response
    {
        $formation = new Formations();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $programmePedagoFile */
            $programmePedagoFile = $form->get('programmePedago')->getData();
            if ($programmePedagoFile instanceof UploadedFile) {
                $filename = pathinfo($programmePedagoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $filename . '-' . uniqid() . '.' . $programmePedagoFile->guessExtension();

                try {
                    $programmePedagoFile->move($this->getParameter('pedago_directory'), $newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $formation->setProgrammePedagoFile($newFilename);
                $this->addFlash('success', 'Le fichier a été téléchargé avec succès.');
            }
            $this->em->persist($formation);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajouté avec succès');
            return $this->redirectToRoute('admin.formation.index');
        }

        return $this->render('admin/formation/formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form->createView(),
        ]);
    }




    #[Route(path: '/admin/formation/{id}', name: 'admin.formation.edit', methods: 'GET|POST')]
    public function edit(Formations $formation, Request $request): Response
    {
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $programmePedagoFile */
            $programmePedagoFile = $form->get('programmePedago')->getData();

            if ($programmePedagoFile instanceof UploadedFile) {
                $filename = pathinfo($programmePedagoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $filename . '-' . uniqid() . '.' . $programmePedagoFile->guessExtension();

                try {
                    $programmePedagoFile->move($this->getParameter('pedago_directory'), $newFilename);
                } catch (FileException $e) {
                    // handle exception if something happens during file upload
                }

                $formation->setProgrammePedagoFile($newFilename);
                $this->addFlash('success', 'Le fichier a été téléchargé avec succès.');
            }

            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.formation.index');
        }

        return $this->render('admin/formation/formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form->createView(),
        ]);
    }



    #[Route(path: '/admin/formation{id}', name: 'admin.formation.delete', methods: 'DELETE')]
    public function delete(Formations $formation, Request $request): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $tokenValue = $request->get('_token');
        if (!is_string($tokenValue)) {
            throw new \InvalidArgumentException('Invalid CSRF token value');
        }

        $csrfToken = new CsrfToken('delete' . $formation->getId(), $tokenValue);

        if ($this->isCsrfTokenValid('delete' . $formation->getId(), $csrfToken->getValue())) {
            $this->em->remove($formation);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succés');
        }
        return $this->redirectToRoute('admin.formation.index');
    }
}
