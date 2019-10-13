<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VillageController extends AbstractController
{
    /**
     * @Route("/village", name="village")
     */
    public function index()
    {
        return $this->render('village.html.twig');
    }

}