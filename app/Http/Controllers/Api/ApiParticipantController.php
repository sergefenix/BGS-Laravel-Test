<?php

namespace App\Http\Controllers\Api;

use App\Mail\NewParticipant;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Controllers\LogMessageController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreParticipant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Participant;
use Exception;
use App\Event;

class ApiParticipantController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Participant[]|Renderable|Collection
     */
    public function index()
    {
        return Participant::all();
    }

    /**
     * @param StoreParticipant $request
     *
     * @return JsonResponse
     */
    public function store(StoreParticipant $request): JsonResponse
    {
        $event_id = Event::find($request->input('event_id'))->id;
        $participant = Participant::create([
            'name'     => $request->input('name'),
            'surname'  => $request->input('surname'),
            'email'    => $request->input('email'),
            'event_id' => $event_id,
        ]);

        $user = User::first();
        Mail::to($user)->queue(new NewParticipant($participant));

        return response()->json($participant, 201);
    }

    /**
     * @param Participant $participant
     * @param Request     $request
     *
     * @return Application|Factory|JsonResponse|View
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

        return response()->json($participant, 200);
    }

    /**
     * @param Participant $participant
     *
     * @return JsonResponse|RedirectResponse
     * @throws Exception
     */
    public function delete(Participant $participant)
    {
        $participant->delete();

        return response()->json(null, 204);
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
