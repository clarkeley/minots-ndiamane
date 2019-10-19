<?php


namespace App\Controller;


use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgendaController extends AbstractController
{
    /**
     * @Route("/agenda", name="agenda")
     * @param EventRepository $eventRepository
     * @return Response
     */
    public function index(EventRepository $eventRepository)
    {
        $events = $eventRepository->getAll();
        $lastEvent = $eventRepository->lastEvent();

        return $this->render('agenda/events.html.twig', ['lastEvent' => $lastEvent, 'events' => $events]);
    }

    /**
     * @Route("/agenda/archives", name="agenda_archives")
     * @param EventRepository $eventRepository
     * @return Response
     */
    public function archives(EventRepository $eventRepository)
    {
        $event = $eventRepository->getAll();

        return $this->render('agenda/eventArchives.html.twig', ['event' => $event]);
    }

    /**
     * @Route("/agenda/{id}", name="agenda_show")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);

        if (!$event) {
            throw $this->createNotFoundException(
                'No album found for id '.$id
            );
        }

        return $this->render('agenda/eventShow.html.twig', ['event' => $event]);

    }

}