<?php

namespace Tests\Unit;

use App\City;
use App\Event;
use Tests\TestCase;
use App\Participant;

class EventTest extends TestCase
{
    public function testEventsAreListedCorrectly(): void
    {
        factory(Event::class)->create([
            'name'       => 'Work',
            'date_start' => '2020-01-01',
            'city_id'    => City::first()->id
        ]);

        $headers = ['Authorization' => "Bearer $this->token"];

        $this->json('GET', '/api/events', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'date_start', 'city_id'],
            ]);
    }

    public function testsEventsAreDeletedCorrectly(): void
    {
        $headers = ['Authorization' => "Bearer $this->token"];

        $event = factory(Event::class)->create([
            'name'       => 'Work',
            'date_start' => '2020-01-01',
            'city_id'    => City::first()->id
        ]);

        $participant = factory(Participant::class)->create([
            'name'     => 'Test Name',
            'surname'  => 'Test Surname',
            'event_id' => $event->id,
            'email'    => 'test@gmail.com',
        ]);

        $this->json('DELETE', "/api/events/$event->id/delete", [], $headers)
            ->assertStatus(204);

        $this->json('GET', "/api/participants/$participant->id/show", [], $headers)
            ->assertStatus(200)
            ->assertJson([
                'name'     => 'Test Name',
                'surname'  => 'Test Surname',
                'event_id' => null,
                'email'    => 'test@gmail.com',
            ]);
    }

    public function testsEventsAreShowCorrectly(): void
    {
        $headers = ['Authorization' => "Bearer $this->token"];

        $event = factory(Event::class)->create([
            'name'       => 'Event',
            'date_start' => '2018-01-01',
            'city_id'    => City::first()->id
        ]);

        $this->json('GET', "/api/events/$event->id/show", [], $headers)
            ->assertStatus(200)
            ->assertJson([
                'name'       => 'Event',
                'date_start' => '2018-01-01',
                'city_id'    => City::first()->name
            ]);
    }
}
