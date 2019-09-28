<?php


namespace App\Services;

use \DrewM\MailChimp\MailChimp;
use Symfony\Component\Form\FormInterface;

class MailchimpList
{
    public function addList(FormInterface $form)
    {
        $builder = $form->getData();
        $MailChimp = new MailChimp('ed0ab95c3efa7ca550d2b7ad7a75c61b-us4');

        dd($result = $MailChimp->get('lists'), print_r($result));

       /* $list_id = 'e39b70bcac';

        $result = $Mailchimp->post("lists/$list_id/members", [
            'email_address' => $builder['email'],
            'status' => 'subscribed'
        ]);
        if ($Mailchimp->success()) {
        dd($result);
    } else {
        dd($Mailchimp->getLastResponse());
    }*/

    }

}