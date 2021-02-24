<?php

namespace App\Controller;

use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;

class EventController extends AbstractController
{
    /**
     * @Route("/event" , name="app_event")
     * @param EventRepository $repo
     * @return Response
     */
    public function index(EventRepository $repo) : Response
    {
        $events = $repo->findAll();

        return $this->render('/event/index.html.twig', compact('events'));
    }

    /**
     * @Route("/event/{id<[0-9]+>}", name="app_event_show", methods="GET")
     * @param Event $event
     * @return Response
     */
    public function show(Event $event) : Response
    {
        return $this->render('/event/show.html.twig', compact('event'));
    }
}
