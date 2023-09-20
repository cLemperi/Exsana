<?php

namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;

class AlerteAdminService implements AlerteAdminServiceInterface
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMailToAdminFromContact(?string $userEmail, string $firstname, string $name, string $message): void
    {
        if ($userEmail === null) {
            return;
        }

        $email = (new Email())
            ->from(new Address('adminexsanabot@exsanaformation.fr'))
            ->to(new Address('lemperiere.charles@gmail.com'))
            ->subject('Le client '.$firstname.' '.$name.' vous à envoyer un message via le formulaire de contact')
            ->html(
                'Bonjour Admin,<br><br>'.$firstname.' '.$name.'vous à envoyer un message via le formulaire de contact,<br><br>
                voici l appercue du message :<br><br>
                '.$message.'<br><br>
                veuillez retrouver le message dans le back-office du site exsana ou le contacter directement au mail suivant : '.$userEmail.''
            );

        $this->mailer->send($email);
    }
}