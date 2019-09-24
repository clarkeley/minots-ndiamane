<?php


namespace App\Services;

use \DrewM\MailChimp\MailChimp;
use Symfony\Component\Form\FormInterface;

class MailchimpList
{
    public function addList(FormInterface $form)
    {
        $builder = $form->getData();
        $Mailchimp = new MailChimp('1ed4087b2711d691442d951b2e76dce5-us4');
        $list_id = 'e39b70bcac';

        $result = $Mailchimp->post("lists/$list_id/members", [
            'email_address' => $builder['email'],
            'status' => 'subscribed'
        ]);
    }

}