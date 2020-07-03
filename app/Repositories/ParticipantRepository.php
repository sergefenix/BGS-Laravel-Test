<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Participant;

class ParticipantRepository extends BaseRepository
{

    /**
     * @return string
     */
    public function model()
    {
        return Participant::class;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return Participant::create(
            [
                'name'     => $data['name'],
                'surname'  => $data['surname'],
                'email'    => $data['email'],
                'event_id' => $data['event_id']
            ]
        );
    }

    /**
     * @param Participant $participant
     * @param array       $data
     *
     * @return mixed
     */
    public function update(Participant $participant, array $data): Participant
    {
        $participant->fill(
            [
                'name'     => $data['name'],
                'surname'  => $data['surname'],
                'email'    => $data['email'],
                'event_id' => $data['event_id']
            ]
        );

        $participant->save();

        return $participant;
    }

    /**
     * @param array $data
     * @param int   $count
     *
     * @return Collection|Model[]
     */
    public function paginateWhereEvent(array $data, int $count)
    {
        if (array_key_exists('event_id', $data)) {
            return Participant::where('event_id', $data['event_id'])->paginate($count);
        }

        return $this->model->paginate($count);
    }
}
