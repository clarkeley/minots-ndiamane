<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssociationController extends AbstractController
{
    /**
     * @Route("/assos", name="assos")
     */
    public function index()
    {
        return $this->render('association/assos.html.twig');
    }

    /**
     * @return Response
     * @Route("/assos/history", name="history")
     */
    public function history()
    {
        return $this->render('association/history.html.twig');
    }

    /**
     * @return Response
     * @Route("/assos/actions", name="actions")
     */
    public function actions()
    {
        return $this->render('association/actions.html.twig');
    }

}