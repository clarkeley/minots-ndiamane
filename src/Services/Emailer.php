<?php


namespace App\Services;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mime\Email;

class Emailer
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function doContact(FormInterface $form)
    {
        $builder = $form->getData();

        $email = (new Email())
            ->from($builder['email'])
            ->to('dominique.auguier@minots-ndiamane.fr')
            ->subject('Contact  :'.$builder['nom'] .$builder['prenom'].$builder['objet'])
            ->text($builder['message'])
            ;

        $this->mailer->send($email);
    }

}