<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Participant;
use Exception;
use App\Event;

class EventController extends Controller
{
    public function index(): Renderable
    {
        $events = Event::paginate(5);
        return view('event.events', compact(['events']));
    }

    /**
     * @param Event $event
     *
     * @return Application|Factory|View
     */
    public function show(Event $event)
    {
        $participants = Participant::where('event_id', $event->id)->paginate(5);

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
        $event->delete();

        return redirect()->route('events');
    }
}
