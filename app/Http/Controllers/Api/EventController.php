<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ParticipantRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\EventRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
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
     * EventController constructor.
     *
     * @param EventRepository       $eventRepository
     * @param ParticipantRepository $participantRepository
     */
    public function __construct(EventRepository $eventRepository, ParticipantRepository $participantRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->participantRepository = $participantRepository;
    }

    /**
     * @return Event[]|Collection
     */
    public function index()
    {
        return $this->eventRepository->all();
    }

    /**
     * @param Event $event
     *
     * @return Event
     */
    public function show(Event $event): Event
    {
        $event->participants = $this->participantRepository->where('event_id', $event->id);

        return $event;
    }

    /**
     * @param Event $event
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(Event $event): JsonResponse
    {
        $this->eventRepository->delete($event->id);

        return response()->json(null, 204);
    }
}
