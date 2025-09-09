<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

         $this->call(MtMenuSeeder::class);
        // User::where('email', 'shadcn@gmail.com')->delete();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'shadcn@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
        ]);
    }
}
