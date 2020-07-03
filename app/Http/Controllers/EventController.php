<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use App\Repositories\ParticipantRepository;
use Illuminate\Contracts\View\Factory;
use App\Repositories\EventRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;
use App\Event;

class EventController extends Controller
{
    private $eventRepository;
    private $participantRepository;

    public function __construct(EventRepository $eventRepository, ParticipantRepository $participantRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->participantRepository = $participantRepository;
    }

    public function index(): Renderable
    {
        $events = $this->eventRepository->paginate(5);

        return view('event.events', compact(['events']));
    }

    /**
     * @param Event $event
     *
     * @return Application|Factory|View
     */
    public function show(Event $event)
    {
        $participants = $this->participantRepository->where('event_id', $event->id);

        return view('event.show', compact(['event', 'participants']));
    }

    /**
     * @param Event $event
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Event $event): RedirectResponse
    {
        $this->eventRepository->delete($event->id);

        return redirect()->route('events');
    }
}
