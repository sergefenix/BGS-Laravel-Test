<?php

namespace App\Repositories;

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
        return Participant::create([
            'name'     => $data['name'],
            'surname'  => $data['surname'],
            'email'    => $data['email'],
            'event_id' => $data['event_id']
        ]);
    }

    /**
     * @param Participant $participant
     * @param array       $data
     *
     * @return mixed
     */
    public function update(Participant $participant, array $data)
    {
        $participant->fill([
            'name'     => $data['name'],
            'surname'  => $data['surname'],
            'email'    => $data['email'],
            'event_id' => $data['event_id']
        ]);

        return $participant->save();
    }
}
