<?php

namespace App\Repositories;

use App\Event;

class EventRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return Event::class;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return Event::create(
            [
                'name'       => $data['name'],
                'date_start' => $data['date_start'],
                'city_id'    => $data['city_id']
            ]
        );
    }

    /**
     * @param Event $event
     * @param array $data
     *
     * @return mixed
     */
    public function update(Event $event, array $data): Event
    {
        $event->fill(
            [
                'name'       => $data['name'],
                'date_start' => $data['date_start'],
                'city_id'    => $data['city_id']
            ]
        );

        $event->save();

        return $event;
    }
}
