<?php


namespace App\Services;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class Emailer
{
    public function doContact(MailerInterface $mailer, FormInterface $form)
    {
        $builder = $form->getData();

        $email = (new Email())
            ->from($builder['email'])
            ->to('ndiamane.lesminots@gmail.com')
            ->subject('Contact  :'.$builder['nom'] .$builder['prenom'].$builder['objet'])
            ->setBody($builder['message'])
            ;

        $mailer->send($email);
    }

}