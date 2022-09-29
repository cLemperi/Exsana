<?php

namespace App\Controller\Admin;

use App\Repository\MessageFromContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMessageController extends AbstractController
{
    #[Route('/admin/message', name: 'app_admin_message')]
    public function index( MessageFromContactRepository $repo): Response
    {
       $messageFromContact =  $repo->findAll();

       return $this->render('admin/formation/message/index.html.twig', [
            'messages' => $messageFromContact,
            'controller_name' => 'AdminMessageController',
        ]);
    }

    #[Route('/admin/message/{id}', name: 'app_admin_message_id')]
    public function messageContact( MessageFromContactRepository $repo, $id): Response
    {
       $message =  $repo->find($id);

       return $this->render('admin/formation/message/read.html.twig', [
            'message' => $message,
            'controller_name' => 'AdminMessageController',
        ]);
    }
}
