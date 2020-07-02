<?php

namespace Tests\Feature\Feature;

use App\User;
use Tests\TestCase;

class LoginTest extends TestCase
{

    public function testUserIsLoggedOutProperly(): void
    {
        $headers = ['Authorization' => "Bearer $this->token"];

        $this->json('get', '/api/cities', [], $headers)->assertStatus(200);
        $this->json('post', '/api/logout', [], $headers)->assertStatus(200);

        $api_token = User::find($this->user->id)->api_token;
        $this->assertEquals(null, $api_token);
    }

    public function testUserWithNullToken(): void
    {
        // Simulating login
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        // Simulating logout
        $user->api_token = null;
        $user->save();

        $this->json('get', '/api/cities', [], $headers)->assertStatus(401);
    }

    public function testRequiresEmailAndLogin(): void
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                'errors'  => [
                    'email'    => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }

    public function testUserLoginsSuccessfully(): void
    {
        factory(User::class)->create([
            'name'     => 'Sergefenix',
            'email'    => 'sergefenix@gmail.com',
            'password' => bcrypt('sergefenix1'),
        ]);

        $payload = ['email' => 'sergefenix@gmail.com', 'password' => 'sergefenix1'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
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
}
