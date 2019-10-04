<?php


namespace App\Services;

use \DrewM\MailChimp\MailChimp;
use Symfony\Component\Form\FormInterface;

class MailchimpList
{
    public function addList(FormInterface $form)
    {
        $builder = $form->getData();
        $mailchimp = new MailChimp('ed0ab95c3efa7ca550d2b7ad7a75c61b-us4');

        $list_id = 'e39b70bcac';

        $result = $mailchimp->post("lists/$list_id/members", [
            'email_address' => $builder['email'],
            'status' => 'subscribed'
        ]);
        if ($mailchimp->success()) {
            dd($result);
        } else {
            dd($mailchimp->getLastResponse());
        }

    }

}