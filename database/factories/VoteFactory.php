<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Election;
use Illuminate\Http\Request;

/**
 *  Vote Schema:
 *      Vote -> [id, data, user_id, election_id, created_at, updated_at]
 *          id          -> unique vote id integer
 *          user_id     -> unique id SQL index of the user who casted the vote
 *          election_id -> unique id SQL index of the election to which this vote relates
 *          created_at  -> time id for when the vote was cast in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 *          updated_at  -> time id for the last time the vote was edited in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 * 
 *   definition() is called by database/Seeder/DatabaseSeeder.php with \App\Models\Vote::factory(1000)->create();
 */

class VoteFactory extends Factory
{
    /**
     * Used for seeding the database with dummy data for demos and testing:
     *
     * @return array
     */
    public function definition()
    {
        $electionIDs = Election::all(); //creates set of all elections ids eg. {1, 2, 5, ..., n}
        $electionSelected = strval(rand(1, $electionIDs -> count())); //random election is selected returning the string of the id number
        $candidateSet = DB::table('candidates')->where('election_id', strval($electionSelected))->get(); //queries all candidates who belong to the selected election
        $candidateSelected = rand(1, 24);
        $candidateSelected = floor($candidateSelected * $candidateSelected / 100)+1; //projects random value onto a distribution curve to create dummy data
        $data = '0';
        foreach($candidateSet as $c) //loop finds candidate ID number for selected candidate and stored that value in $data
        {
            $candidateSelected -= 1;
            if ($candidateSelected == 0)
            {
                $data = $c->id;
            }
        }

        return [
            'data' => $data, //Str::random(10)
            'user_id' => 0,
            'election_id' => $electionSelected,
            'created_at' => now(), // password
            'updated_at' => now(),
        ];
    }
}
