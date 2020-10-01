<?php

namespace App\Controller;

use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;

class EventsController extends AbstractController
{
    /**
     * @Route("/events" , name="app_events")
     * @param EventRepository $repo
     * @return Response
     */
    public function index(EventRepository $repo) : Response
    {
        $events = $repo->findAll();

        return $this->render('/events/index.html.twig', compact('events'));
    }

    /**
     * @Route("/events/{id<[0-9]+>}", name="app_events_show", methods="GET")
     * @param Event $event
     * @return Response
     */
    public function show(Event $event) : Response
    {
        return $this->render('/events/show.html.twig', compact('event'));
    }
}
