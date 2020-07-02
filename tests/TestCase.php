<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $token;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:rollback');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $this->user = factory(User::class)->create();
        $this->token = $this->user->generateToken();

    }
}
