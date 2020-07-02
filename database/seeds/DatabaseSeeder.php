<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        Model::unguard(); // Disable mass assignment

        $this->call(CitiesSeeder::class);
        $this->call(EventsSeeder::class);
        $this->call(ParticipantsSeeder::class);

        Model::reguard(); // Enable mass assignment
    }
}
