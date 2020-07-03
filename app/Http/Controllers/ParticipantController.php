<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use App\Repositories\ParticipantRepository;
use App\Http\Requests\StoreParticipant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewParticipant;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Participant;
use Exception;
use App\User;

class ParticipantController extends Controller
{
    /**
     * @var ParticipantRepository
     */
    private $participantRepository;

    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * ParticipantController constructor.
     *
     * @param ParticipantRepository $participantRepository
     * @param EventRepository       $eventRepository
     */
    public function __construct(ParticipantRepository $participantRepository, EventRepository $eventRepository)
    {
        $this->participantRepository = $participantRepository;
        $this->eventRepository = $eventRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $participants = $this->participantRepository->paginate(10);

        return view('participant.participants', compact(['participants']));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $events = $this->eventRepository->all();

        return view('participant.create', compact(['events']));
    }

    /**
     * @param StoreParticipant $request
     *
     * @return RedirectResponse
     */
    public function store(StoreParticipant $request): RedirectResponse
    {
        $participant = $this->participantRepository->create($request->input());

        $user = User::first();
        Mail::to($user)->queue(new NewParticipant($participant));

        return redirect()->route('participants');
    }

    /**
     * @param Participant $participant
     *
     * @return Application|Factory|View
     */
    public function edit(Participant $participant)
    {
        $events = $this->eventRepository->all();

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
        $participant = $this->participantRepository->update($participant, $request->input());

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
        $this->participantRepository->delete($participant->id);

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
