<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use App\Repositories\ParticipantRepository;
use App\Http\Requests\StoreParticipant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Repositories\EventRepository;
use App\Repositories\UserRepository;
use App\Mail\NewParticipant;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Jobs\SendMail;
use App\Participant;
use Exception;

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
     * @var UserRepository
     */
    private $userRepository;

    /**
     * ParticipantController constructor.
     *
     * @param ParticipantRepository $participantRepository
     * @param EventRepository       $eventRepository
     * @param UserRepository        $userRepository
     */
    public function __construct(
        ParticipantRepository $participantRepository,
        EventRepository $eventRepository,
        UserRepository $userRepository
    ) {
        $this->participantRepository = $participantRepository;
        $this->eventRepository = $eventRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        $participants = $this->participantRepository->paginateWhereEvent($request->input(), 10);
        $events = $this->eventRepository->all();

        return view('participant.index', compact(['participants', 'events']));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): Renderable
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

        $user = $this->userRepository->first();
        SendMail::dispatch(new NewParticipant($participant), $user);

        return redirect()->route('participants');
    }

    /**
     * @param Participant $participant
     *
     * @return Application|Factory|View
     */
    public function edit(Participant $participant): Renderable
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
    public function update(Participant $participant, Request $request): Renderable
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
    public function show(Participant $participant): Renderable
    {
        return view('participant.show', compact(['participant']));
    }
}
