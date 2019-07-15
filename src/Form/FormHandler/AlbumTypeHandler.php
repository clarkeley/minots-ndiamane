<?php


namespace App\Form\FormHandler;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class AlbumTypeHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($form->getData());
            $this->entityManager->flush();

            return true;
        }

        return false;
    }

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}