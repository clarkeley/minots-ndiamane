<?php


namespace App\Form\FormHandler;


use App\Services\Emailer;
use Symfony\Component\Form\FormInterface;

class ContactTypeHandler
{
    private $mailer;

    public function __construct(Emailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->mailer->doContact($form);
        }

        return false;
    }
}