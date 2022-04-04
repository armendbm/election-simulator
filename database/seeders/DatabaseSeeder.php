<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * seeds database with votes for all elections and all candidates
     * 
     * Note: there must already be elections created by users. The seeder
     *       function adds votes to elections such that for some set of
     *       candidates: {1, 2, ..., n} the seeder gives a random number of
     *       votes averaging to floor((n-i)^2/100) per candidate where
     *       i related to the current candidate number
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Vote::factory(1000)->create();
    }
}
