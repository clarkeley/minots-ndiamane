<?php


namespace App\Form\FormHandler;

use App\Services\MailchimpList;
use Symfony\Component\Form\FormInterface;

class NewsTypeHandler
{
    /**
     * @var $mailchimpList
     */
    private $mailchimpList;
    public function __construct(MailchimpList $mailchimpList)
    {
        $this->mailchimpList = $mailchimpList;
    }
    public function handle(FormInterface $form) : bool
    {
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->mailchimpList->addList($form);
            return true;
        }
        return false;
    }
}