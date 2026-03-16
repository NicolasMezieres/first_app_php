<?php

namespace App\Service;

use App\Dto\MailerDto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private MailerInterface $mailer;
    public function __construct(MailerInterface $mailer, public string $smtpEmail)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(MailerDto $mailerDto)
    {
        $email = (new Email())
            ->from($this->smtpEmail)
            ->replyTo($mailerDto->email)
            ->to($this->smtpEmail)
            ->subject($mailerDto->subject)
            ->html("<h1>Email Client : " . $mailerDto->email . "</h1>" .
                "<p>" . $mailerDto->text . "</p>");
        $this->mailer->send($email);
    }
}
