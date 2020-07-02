<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testsRegistersSuccessfully(): void
    {
        $payload = [
            'name'                  => 'Sergefenix',
            'email'                 => 'sergefenix1@gmail.com',
            'password'              => 'sergefenix1',
            'password_confirmation' => 'sergefenix1',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);
    }

    public function testsRequiresPasswordEmailAndName(): void
    {
        $this->json('post', '/api/register')
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                'errors'  => [
                    'name'     => ['The name field is required.'],
                    'email'    => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }

    public function testsRequirePasswordConfirmation(): void
    {
        $payload = [
            'name'     => 'Sergefenix',
            'email'    => 'sergefenix@gmail.com',
            'password' => 'sergefenix1',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                'errors'  => [
                    'password' => ['The password confirmation does not match.'],
                ]
            ]);
    }
}
