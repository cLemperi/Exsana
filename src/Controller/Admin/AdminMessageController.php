<?php

namespace App\Controller\Admin;

use App\Entity\FormContact;
use App\Entity\UserMessage;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FormContactRepository;
use App\Repository\UserMessageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Config\Framework\FormConfig;

class AdminMessageController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    //index admin message
    #[Route('/admin/message', name: 'app_admin_message')]
    public function index(UserMessageRepository $repo, FormContactRepository $formrepo): Response
    {
        // Récupérez uniquement les messages où isArchived est null ou false
        $messageFromContact = $repo->findNotArchived();
        $messageFromUnknow = $formrepo->findNotArchived();

        return $this->render('admin/formation/message/index.html.twig', [
            'messagesUnknow' => $messageFromUnknow,
            'messages' => $messageFromContact,
            'controller_name' => 'AdminMessageController',
        ]);
    }

    //read message
    #[Route('/admin/message/{id}', name: 'app_admin_message_id')]
    public function messageContact(
        UserMessageRepository $repo,
        int $id,
        FormContactRepository $formrepo
    ): Response {

        $message =  $repo->find($id);

        return $this->render('admin/formation/message/read.html.twig', [
            'message' => $message,
            'controller_name' => 'AdminMessageController',
        ]);
    }

    //read message unk
    #[Route('/admin/messageunk/{id}', name: 'app_admin_message_unk_id')]
    public function messageContactUnknow(FormContactRepository $repo, int $id): Response
    {
        $message =  $repo->find($id);

        return $this->render('admin/formation/message/readUnk.html.twig', [
            'message' => $message,
            'controller_name' => 'AdminMessageController',
        ]);
    }

    //delete message sur la page message
    #[Route(path: '/admin/message/{id}/delete', name: 'admin.message.delete', methods: 'POST')]
    public function delete(UserMessage $message, Request $request): Response
    {
        $tokenValue = $request->get('_token');
        if (!is_string($tokenValue)) {
            // Si vous utilisez AJAX, renvoyez une réponse JSON appropriée ici.
            throw new \InvalidArgumentException('Invalid CSRF token value');
        }

        $csrfToken = new CsrfToken('delete' . $message->getId(), $tokenValue);

        if ($this->isCsrfTokenValid('delete' . $message->getId(), $csrfToken->getValue())) {
            $this->em->remove($message);
            $this->em->flush();
            $this->addFlash('success', 'Message supprimé avec succés');
        }
        return $this->redirectToRoute('app_admin_message');
    }

    //delete message unk sur la page message
    #[Route(path: '/admin/messageUnk/{id}/delete', name: 'admin.messageUnk.delete', methods: 'POST')]
    public function deleteMessageUnk(FormContact $message, Request $request): Response
    {
        $tokenValue = $request->get('_token');
        if (!is_string($tokenValue)) {
            // Si vous utilisez AJAX, renvoyez une réponse JSON appropriée ici.
            throw new \InvalidArgumentException('Invalid CSRF token value');
        }

        $csrfToken = new CsrfToken('delete' . $message->getId(), $tokenValue);

        if ($this->isCsrfTokenValid('delete' . $message->getId(), $csrfToken->getValue())) {
            $this->em->remove($message);
            $this->em->flush();
            $this->addFlash('success', 'Message supprimé avec succés');
        }
        return $this->redirectToRoute('app_admin_message');
    }
    
    //index archive
    #[Route('/admin/archive', name: 'app_admin_archive')]
    public function indexArchive(UserMessageRepository $repo, FormContactRepository $formrepo): Response
    {
        $messageFromContact =  $repo->findBy(['isArchived' => true]);
        $messageFromUnknow = $formrepo->findBy(['isArchived' => true]);

        return $this->render('admin/formation/message/message-archive/index.html.twig', [
            'messagesUnknow' => $messageFromUnknow,
            'messages' => $messageFromContact,
            'controller_name' => 'AdminMessageController',
        ]);
    }
    
    #[Route(path: '/admin/message/{id}/archive', name: 'admin.message.archive', methods: 'POST')]
    public function archive(UserMessage $message, Request $request): Response
    {
        $tokenValue = $request->get('_token');
        if (!is_string($tokenValue)) {
            throw new \InvalidArgumentException('Invalid CSRF token value');
        }

        $csrfToken = new CsrfToken('archive' . $message->getId(), $tokenValue);

        if ($this->isCsrfTokenValid('archive' . $message->getId(), $csrfToken->getValue())) {
            $message->setIsArchived(true);
            $this->em->persist($message);
            $this->em->flush();
            $this->addFlash('success', 'Message archivé avec succès');
        }
        return $this->redirectToRoute('app_admin_archive');
    }

    #[Route(path: '/admin/messageUnk/{id}/archive', name: 'admin.messageUnk.archive', methods: 'POST')]
    public function archiveUnk(FormContact $message, Request $request): Response
    {
        $tokenValue = $request->get('_token');
        if (!is_string($tokenValue)) {
            throw new \InvalidArgumentException('Invalid CSRF token value');
        }

        $csrfToken = new CsrfToken('archive' . $message->getId(), $tokenValue);

        if ($this->isCsrfTokenValid('archive' . $message->getId(), $csrfToken->getValue())) {
            $message->setIsArchived(true);
            $this->em->persist($message);
            $this->em->flush();
            $this->addFlash('success', 'Message archivé avec succès');
        }
        return $this->redirectToRoute('app_admin_archive');
    }

    #[Route(path: '/admin/message/{id}/delete/archive', name: 'admin.message.delete.archive', methods: 'POST')]
    public function deleteMessageArchive(UserMessage $message, Request $request): Response
    {
        $tokenValue = $request->get('_token');
        if (!is_string($tokenValue)) {
            // Si vous utilisez AJAX, renvoyez une réponse JSON appropriée ici.
            throw new \InvalidArgumentException('Invalid CSRF token value');
        }

        $csrfToken = new CsrfToken('delete' . $message->getId(), $tokenValue);

        if ($this->isCsrfTokenValid('delete' . $message->getId(), $csrfToken->getValue())) {
            $this->em->remove($message);
            $this->em->flush();
            $this->addFlash('success', 'Message supprimé avec succés');
        }
        return $this->redirectToRoute('app_admin_archive');
    }
    #[Route(path: '/admin/messageUnk/{id}/delete/archive', name: 'admin.messageUnk.delete.archive', methods: 'POST')]
    public function deleteMessageUnkArchive(FormContact $message, Request $request): Response
    {
        $tokenValue = $request->get('_token');
        if (!is_string($tokenValue)) {
            // Si vous utilisez AJAX, renvoyez une réponse JSON appropriée ici.
            throw new \InvalidArgumentException('Invalid CSRF token value');
        }

        $csrfToken = new CsrfToken('delete' . $message->getId(), $tokenValue);

        if ($this->isCsrfTokenValid('delete' . $message->getId(), $csrfToken->getValue())) {
            $this->em->remove($message);
            $this->em->flush();
            $this->addFlash('success', 'Message supprimé avec succés');
        }
        return $this->redirectToRoute('app_admin_archive');
    }
}
