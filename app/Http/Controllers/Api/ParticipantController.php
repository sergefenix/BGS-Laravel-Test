<?php

namespace App\Http\Controllers\Api;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\ParticipantRepository;
use App\Http\Requests\StoreParticipant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
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
     * @var UserRepository
     */
    private $userRepository;

    /**
     * ParticipantController constructor.
     *
     * @param ParticipantRepository $participantRepository
     * @param UserRepository        $userRepository
     */
    public function __construct(ParticipantRepository $participantRepository, UserRepository $userRepository)
    {
        $this->participantRepository = $participantRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return Participant[]|Renderable|Collection
     */
    public function index(Request $request)
    {
        return $this->participantRepository->paginateWhereEvent($request->input(), 10);
    }

    /**
     * @param StoreParticipant $request
     *
     * @return JsonResponse
     */
    public function store(StoreParticipant $request): JsonResponse
    {
        $participant = $this->participantRepository->create($request->input());

        $user = $this->userRepository->first();
        SendMail::dispatch(new NewParticipant($participant), $user);

        return response()->json($participant, Response::HTTP_CREATED);
    }

    /**
     * @param Participant $participant
     * @param Request     $request
     *
     * @return Application|Factory|JsonResponse|View
     */
    public function update(Participant $participant, Request $request)
    {
        $participant = $this->participantRepository->update($participant, $request->input());

        return response()->json($participant, Response::HTTP_OK);
    }

    /**
     * @param Participant $participant
     *
     * @return JsonResponse|RedirectResponse
     * @throws Exception
     */
    public function delete(Participant $participant)
    {
        $this->participantRepository->delete($participant->id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Participant $participant
     *
     * @return Participant
     */
    public function show(Participant $participant): Participant
    {
        return $participant;
    }
}
