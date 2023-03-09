<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailController extends AbstractController
{
    #[Route('/mail', name: 'app_mail')]
    public function index(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('Exsanaformation@exsanaformation.fr')
            ->to('lemperiere.charles@gmail.com')
            ->subject('Test d\'envoi de mail')
            ->text('Ceci est un test d\'envoi de mail avec Symfony.');

        $mailer->send($email);

        return new Response('Mail envoyé avec succès !');
    }
}
