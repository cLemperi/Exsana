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

    public function sendMailToAdminFromContact(?string $userEmail): void
    {
        if ($userEmail === null) {
            return;
        }

        $email = (new Email())
            ->from(new Address('Exsanaformation@exsanaformation.fr'))
            ->to(new Address('lemperiere.charles@gmail.com'))
            ->subject('Un client vous à envoyer un message via le formulaire de contact')
            ->text(
                'Bonjour, un client vous à envoyer un message via le formulaire de contact, veuillez retrouver le message dans le back-office du site exsana.'
            );

        $this->mailer->send($email);
    }
}