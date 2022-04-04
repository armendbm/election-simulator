<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // John Sturman is the Creator of All Elections, and we must log into
        // his account to see the results (as of now).
        $john_sturman = User::factory()
            ->has(
                Election::factory()
                    ->count(10)
                    ->state(new Sequence(
                        ['system' => 'fptp'],
                        ['system' => 'irv'],
                    ))
                    ->has(
                        Candidate::factory()
                            ->count(5)
                    ),
                'own_elections'
            )
            ->create([
                'name' => 'John Sturman',
                'email' => 'john@sturman.com',
                // Hash value of 'johnsturman'
                'password' => '$2y$10$tpm76Q3kS6WkeHCvsJ0yJOV6ZGQmAre7FNCZfDP3UMw90sJhv7OK.',
            ]);
        $users = User::factory()->count(100)->make();
    }
}
