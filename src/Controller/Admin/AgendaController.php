<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Entity\Tag;
use App\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AgendaController extends AbstractController
{
    /**
     * @Route("/agenda", name="agenda")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) : Response
    {
        $event = new Event();

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Succès !');

            return $this->redirectToRoute('agenda');

        }else{
            $this->addFlash('danger', 'erreur');
        }

        return $this->render('agenda/index.html.twig', array('form' => $form->createView()));
    }
}
