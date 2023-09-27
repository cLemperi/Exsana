<?php

namespace App\Controller\Admin;

use App\Repository\CuriculumRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCuriculumController extends AbstractController
{
    #[Route(path: '/admin/curiculum/index', name: 'admin.curiculum.index')]
    public function curiculums(CuriculumRepository $repo): Response
    {
        $curiculum = $repo->findAll();
        return $this->render('curriculum/index.html.twig', [
            "curiculum" => $curiculum,
            'controller_name' => 'AdminFormationController',
        ]);
    }

    #[Route(path: '/admin/curiculum/{id}', name: 'admin.curiculum')]
    public function curiculum(): Response
    {
        return $this->render('admin/formation/formation/index.html.twig', [
            'controller_name' => 'AdminFormationController',
        ]);
    }
}
