<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;

interface UserRegistrationServiceInterface
{
    public function __construct(MailerInterface $mailer);
    public function sendRegistrationEmail(?string $userEmail): void;
    public function sendRegistrationFormationEmail(?string $userEmail, string $formationTitle): void;
}
