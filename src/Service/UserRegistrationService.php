<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class UserRegistrationService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendRegistrationEmail($userEmail)
    {
        $email = (new Email())
            ->from('exsanaformation@exsanaformation.fr')
            ->to($userEmail)
            ->subject('Inscription à Exsana réussie')
            ->text(
                'Bonjour, votre inscription sur notre site Exsana Formation a été confirmée.<br> Vous pouvez des à présent vous inscrire à des sessions de formations sur notre site<br><br> A très vite<br> Exsana Formation');

        $this->mailer->send($email);
    }

    public function sendRegistrationFormationEmail($userEmail, $formationTitle)
    {
        $email = (new Email())
            ->from('exsanaformation@exsanaformation.fr')
            ->to($userEmail)
            ->subject('Confirmation d\'inscription à la formation' . $formationTitle)
            ->text(
                'Bonjour, votre inscription à la formation' . $formationTitle . ' à bien était effuctué, vous allez être contacter par téléphone par notre équipe.<br> À très vite <br><br> l\'équipe Exsana Formation');

        $this->mailer->send($email);
    }
}
