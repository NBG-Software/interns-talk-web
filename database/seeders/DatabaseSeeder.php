<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Mentor;
use App\Models\Message;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(5)->create();
        // User::factory()->mentor()->count(5)->create();
        // Mentor::factory(5)->create();
        // Chat::factory(400)->create();
        // Message::factory(400)->create();

        User::factory()->createMany([
            [
                'first_name' => 'Shwe',
                'last_name' => 'Zin',
                'email' => 'shwezin2001shwezin2001@gmail.com',
                'password' => Hash::make('shwezin123'),
                'role' => 'mentor',
                'profile_picture' => fake()->imageUrl(200, 200, 'people', true, 'profile'),
            ],
            [
                'first_name' => 'Ko',
                'last_name' => 'Htwe',
                'email' => 'sankyawhtwe.personal@gmail.com',
                'password' => Hash::make('sanhtwe1234'),
                'role' => 'intern',
                'profile_picture' => fake()->imageUrl(200, 200, 'people', true, 'profile'),
            ],
        ]);

        Mentor::factory()->create([
            'user_id' => 1,
            'expertise' => 'something',
            'company' => 'somewhere',
        ]);

        // creating own chat data
        Chat::factory()->create([
            'mentor_id' => 1,
            'user_id' => 2,
        ]);



    }
}
