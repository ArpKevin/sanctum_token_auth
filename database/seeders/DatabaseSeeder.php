<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Csoki;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userid = 18;
        // Create csokik records
        if (Csoki::count() === 0) {
            Csoki::factory()->count(10)->create(); // Create 10 csokik records
        }

        // Generate relationships with the created csokik
        $csokiIds = Csoki::all()->pluck('id'); // Get the IDs of the created csokik
        $user = User::find($userid);
        if ($user) {
            $user->csokik()->attach($csokiIds); // Attach the csokik relationships to the user
        }
    }
}