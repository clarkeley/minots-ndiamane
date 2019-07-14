<?php


namespace App\Form\FormHandler;


use Symfony\Component\Form\FormInterface;

class AlbumTypeHandler
{
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()){
            return true;
        }

        return false;
    }
}