<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FormationsRepository;
use App\Entity\Formation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class FormationController extends AbstractController
{
    /**
     * @Route("/deleteFormation", name="deleteFormation")
     */
    public function delete(): Response {

    }

    /**
     * @Route("/modifyFormation", name="modifyFormation")
     */
    public function modify(): Response{

    }
}
