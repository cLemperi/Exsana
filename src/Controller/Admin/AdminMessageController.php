<?php

namespace App\Controller\Admin;

use App\Entity\MessageFromContact;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FormContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MessageFromContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminMessageController extends AbstractController
{
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

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
    public function messageContact(
        MessageFromContactRepository $repo,
        int $id,
        FormContactRepository $formrepo
    ): Response {

            $message =  $repo->find($id);

        return $this->render('admin/formation/message/read.html.twig', [
            'message' => $message,
            'controller_name' => 'AdminMessageController',
        ]);
    }

    #[Route('/admin/messageunk/{id}', name: 'app_admin_message_id')]
    public function messageContactUnknow(FormContactRepository $repo, int $id): Response
    {
        $message =  $repo->find($id);

        return $this->render('admin/formation/message/readUnk.html.twig', [
            'message' => $message,
            'controller_name' => 'AdminMessageController',
        ]);
    }

    #[Route(path: '/admin/message{id}', name: 'admin.message.delete', methods: 'DELETE')]
    public function delete(MessageFromContact $message, Request $request): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $tokenValue = $request->get('_token');
        if (!is_string($tokenValue)) {
            throw new \InvalidArgumentException('Invalid CSRF token value');
        }

        $csrfToken = new CsrfToken('delete' . $message->getId(), $tokenValue);

        if ($this->isCsrfTokenValid('delete' . $message->getId(), $csrfToken->getValue())) {
            $this->em->remove($message);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succés');
        }
        return $this->redirectToRoute('admin.message.index');
    }
}
