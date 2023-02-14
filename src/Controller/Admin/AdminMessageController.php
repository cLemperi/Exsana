<?php

namespace App\Controller\Admin;

use App\Repository\FormContactRepository;
use App\Repository\MessageFromContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMessageController extends AbstractController
{
    #[Route('/admin/message', name: 'app_admin_message')]
    public function index(MessageFromContactRepository $repo, FormContactRepository $formrepo): Response
    {
       $messageFromContact =  $repo->findAll();
       $messageFromUnknow = $formrepo->findAll();
        
       return $this->render('admin/formation/message/index.html.twig', [
            'messagesUnknow' => $messageFromUnknow,
            'messages' => $messageFromContact,
            'controller_name' => 'AdminMessageController',
        ]);
    }

    #[Route('/admin/message/{id}', name: 'app_admin_message_id')]
    public function messageContact( MessageFromContactRepository $repo, $id, FormContactRepository $formrepo): Response
    {
       $message =  $repo->find($id);

       return $this->render('admin/formation/message/read.html.twig', [
            'message' => $message,
            'controller_name' => 'AdminMessageController',
        ]);
    }

    #[Route('/admin/messageunk/{id}', name: 'app_admin_message_id')]
    public function messageContactUnknow( FormContactRepository $repo, $id): Response
    {
       $message =  $repo->find($id);

       return $this->render('admin/formation/message/readUnk.html.twig', [
            'message' => $message,
            'controller_name' => 'AdminMessageController',
        ]);
    }
}
