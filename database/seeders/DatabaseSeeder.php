<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            "first_name" => "John",
            "last_name" => "Doe",
            "email" => "johndoe@example.com",
            "password" => "secret",
        ]);
        User::factory(5)->create();
    }
}
