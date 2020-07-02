<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\StoreParticipant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Queue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Participant;
use Exception;
use App\Event;

class ParticipantController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $participants = Participant::paginate(10);

        return view('participant.participants', compact(['participants']));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $events = Event::all();
        return view('participant.create', compact(['events']));
    }

    /**
     * @param StoreParticipant $request
     *
     * @return RedirectResponse
     */
    public function store(StoreParticipant $request): RedirectResponse
    {
        $event_id = Event::find($request->input('event_id'))->id;
        $participant = Participant::create([
            'name'     => $request->input('name'),
            'surname'  => $request->input('surname'),
            'email'    => $request->input('email'),
            'event_id' => $event_id,
        ]);

        Queue::push(LogMessageController::class,
            ['message' => "New Participant: {$participant->name} | Email: {$participant->email} | Time: " . time()]);

        return redirect()->route('participants');
    }

    /**
     * @param Participant $participant
     *
     * @return Application|Factory|View
     */
    public function edit(Participant $participant)
    {
        $events = Event::all();
        return view('participant.edit', compact('participant', 'events'));
    }

    /**
     * @param Participant $participant
     * @param Request     $request
     *
     * @return Application|Factory|View
     */
    public function update(Participant $participant, Request $request)
    {
        $event_id = Event::find($request->input('event_id'))->id;
        $participant->fill([
            'name'     => $request->input('name'),
            'surname'  => $request->input('surname'),
            'email'    => $request->input('email'),
            'event_id' => $event_id
        ]);

        $participant->save();

        return view('participant.show', compact(['participant']));
    }

    /**
     * @param Participant $participant
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Participant $participant): RedirectResponse
    {
        $participant->delete();

        return redirect()->route('participants');
    }

    /**
     * @param Participant $participant
     *
     * @return Application|Factory|View
     */
    public function show(Participant $participant)
    {
        return view('participant.show', compact(['participant']));
    }
}
