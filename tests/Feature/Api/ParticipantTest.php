<?php

namespace Tests\Feature\Api;

use App\Participant;
use Tests\TestCase;
use App\Event;

class ParticipantTest extends TestCase
{

    public function testsParticipantsAreCreatedCorrectly(): void
    {
        $headers = ['Authorization' => "Bearer $this->token"];

        $payload = [
            'name'     => 'Name One',
            'surname'  => 'Surname One',
            'event_id' => Event::first()->id,
            'email'    => 'first@gmail.com',
        ];

        $this->json('POST', '/api/participants/store', $payload, $headers)
            ->assertStatus(201)
            ->assertJson([
                'name'     => 'Name One',
                'surname'  => 'Surname One',
                'email'    => 'first@gmail.com',
                'event_id' => Event::first()->name,
            ]);
    }

    public function testParticipantsAreUniqEmail(): void
    {
        $headers = ['Authorization' => "Bearer $this->token"];

        $payload = [
            'name'     => 'Name',
            'surname'  => 'Surname',
            'event_id' => Event::first()->id,
            'email'    => 'unique@gmail.com',
        ];

        $this->json('POST', '/api/participants/store', $payload, $headers);
        $this->json('POST', '/api/participants/store', $payload, $headers)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                'errors'  => [
                    'email' => ['Such email already exists'],
                ]
            ]);
    }

    public function testsParticipantsAreUpdatedCorrectly(): void
    {
        $headers = ['Authorization' => "Bearer $this->token"];

        $participant = factory(Participant::class)->create([
            'name'     => 'Name Two',
            'surname'  => 'Surname Two',
            'event_id' => Event::first()->id,
            'email'    => 'second@gmail.com',
        ]);

        $payload = [
            'name'     => 'TestName',
            'surname'  => 'TestSurname',
            'event_id' => Event::first()->id,
            'email'    => 'test@gmail.com',
        ];

        $this->json('POST', "/api/participants/$participant->id/update", $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id'       => $participant->id,
                'name'     => 'TestName',
                'surname'  => 'TestSurname',
                'email'    => 'test@gmail.com',
                'event_id' => Event::first()->name,
            ]);
    }

    public function testsParticipantAreDeletedCorrectly(): void
    {
        $headers = ['Authorization' => "Bearer $this->token"];
        $participant = factory(Participant::class)->create([
            'name'     => 'Name Three',
            'surname'  => 'Surname Three',
            'event_id' => Event::first()->id,
            'email'    => 'third@gmail.com',
        ]);

        $this->json('DELETE', "/api/participants/$participant->id/delete", [], $headers)
            ->assertStatus(204);
    }

    public function testParticipantsAreListedCorrectly(): void
    {
        factory(Participant::class)->create([
            'name'     => 'Name Fore',
            'surname'  => 'Surname Fore',
            'event_id' => Event::first()->id,
            'email'    => 'foud@gmail.com',
        ]);

        $headers = ['Authorization' => "Bearer $this->token"];

        $this->json('GET', '/api/participants', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'surname', 'email', 'event_id', 'created_at', 'updated_at', 'id'],
            ]);
    }

}
