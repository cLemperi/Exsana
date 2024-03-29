<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;

interface AlerteAdminServiceInterface
{
    public function __construct(MailerInterface $mailer);
    public function sendMailToAdminFromContact(
        ?string $userEmail,
        string $firstname,
        string $name,
        string $message
    ): void;
}
