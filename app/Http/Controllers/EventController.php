<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use App\Repositories\ParticipantRepository;
use Illuminate\Contracts\View\Factory;
use App\Repositories\EventRepository;
use Illuminate\Http\RedirectResponse;
use App\Repositories\CityRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Exception;
use App\Event;

class EventController extends Controller
{
    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * @var ParticipantRepository
     */
    private $participantRepository;

    /**
     * @var CityRepository
     */
    private $cityRepository;

    /**
     * EventController constructor.
     *
     * @param EventRepository       $eventRepository
     * @param ParticipantRepository $participantRepository
     * @param CityRepository        $cityRepository
     */
    public function __construct(
        EventRepository $eventRepository,
        ParticipantRepository $participantRepository,
        CityRepository $cityRepository
    ) {
        $this->eventRepository = $eventRepository;
        $this->participantRepository = $participantRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $events = $this->eventRepository->paginate(5);

        return view('event.index', compact(['events']));
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
     * @return Application|Factory|View
     */
    public function create(): Renderable
    {
        $cities = $this->cityRepository->all();

        return view('event.create', compact(['cities']));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->eventRepository->create($request->input());

        return redirect()->route('events');
    }

    /**
     * @param Event $event
     *
     * @return Application|Factory|View
     */
    public function edit(Event $event): Renderable
    {
        $cities = $this->cityRepository->all();

        return view('event.edit', compact('event', 'cities'));
    }

    /**
     * @param Event   $event
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function update(Event $event, Request $request): Renderable
    {
        $event = $this->eventRepository->update($event, $request->input());

        return view('event.show', compact(['event']));
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
