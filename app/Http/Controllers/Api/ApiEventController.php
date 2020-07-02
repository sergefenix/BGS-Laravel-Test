<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Participant;
use Exception;
use App\Event;

class ApiEventController extends Controller
{
    /**
     * @return Event[]|Collection
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * @param Event $event
     *
     * @return Event
     */
    public function show(Event $event): Event
    {
        $participants = Participant::where('event_id', $event->id)->get();
        $event->participants = $participants;
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
        $event->delete();

        return response()->json(null, 204);
    }
}
