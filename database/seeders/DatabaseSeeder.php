<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Mentor;
use App\Models\Message;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        User::factory()->mentor()->count(5)->create();
        // Mentor::factory(5)->create();
        // Chat::factory(400)->create();
        // Message::factory(400)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



    }
}
