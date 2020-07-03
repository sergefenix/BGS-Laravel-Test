<?php

namespace Tests\Unit;

use App\City;
use Tests\TestCase;

class CityTest extends TestCase
{
    public function testCitiesAreListedCorrectly(): void
    {
        factory(City::class)->create([
            'name' => 'Moscow',
        ]);

        $headers = ['Authorization' => "Bearer $this->token"];

        $this->json('GET', '/api/cities', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'name'],
            ]);
    }
}
