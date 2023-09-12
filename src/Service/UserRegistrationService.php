<?php

namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;

class UserRegistrationService implements UserRegistrationServiceInterface
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendRegistrationEmail(?string $userEmail): void
    {
        if ($userEmail === null) {
            return;
        }

        $email = (new Email())
            ->from(new Address('exsanaformation@exsanaformation.fr'))
            ->to(new Address($userEmail))
            ->subject('Inscription à Exsana réussie')
            ->text(
                'Bonjour, votre inscription sur notre site Exsana Formation a été confirmée.<br> 
                Vous pouvez des à présent vous inscrire à des sessions de formations sur notre site<br><br> 
                A très vite<br> Exsana Formation'
            );

        $this->mailer->send($email);
    }

    public function sendRegistrationFormationEmail(?string $userEmail, ?string $formationTitle): void
    {
        if ($userEmail === null) {
            return;
        }

        $email = (new Email())
            ->from(new Address('exsanaformation@exsanaformation.fr'))
            ->to(new Address($userEmail))
            ->subject('Confirmation d\'inscription à la formation' . $formationTitle)
            ->text(
                'Bonjour, votre inscription à la formation' . $formationTitle . ' à bien était effuctué, 
                vous allez être contacter par téléphone par notre équipe.<br> 
                À très vite <br><br> l\'équipe Exsana Formation'
            );

        $this->mailer->send($email);
    }

}
