<?php

namespace App\Service;

use Exception;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class MailerService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendEmail(array $mailData, string $mailContext): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address($mailData['from']['email'], $mailData['from']['name']))
            ->to(new Address($mailData['to']['email'], $mailData['to']['name']))
            ->subject($mailData['subject'])
            ->htmlTemplate($mailContext . '.html.twig')
            ->context([
                'mailData' => $mailData,
            ]);

        try {
            $this->mailer->send($email);
        } catch(Exception $e) {
            dd($e);
        }
    }
}
