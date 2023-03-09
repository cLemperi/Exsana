<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;

interface UserRegistrationServiceInterface
{
    public function __construct(MailerInterface $mailer);
    public function sendRegistrationEmail($userEmail);
    public function sendRegistrationFormationEmail($userEmail, $formationTitle);
}
