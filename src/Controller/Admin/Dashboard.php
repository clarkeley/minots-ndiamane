<?php


namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Dashboard extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */

    public function Hello() {
        return $this->render('security/dashboard.html.twig');
    }

}