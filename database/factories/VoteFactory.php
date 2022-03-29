<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Election;
use Illuminate\Http\Request;

class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $electionIDs = Election::all();
        $electionSelected = strval(rand(1, $electionIDs -> count()));
        $candidateSet = DB::table('candidates')->where('election_id', strval($electionSelected))->get();
        $candidateSelected = rand(1, 24);
        $candidateSelected = floor($candidateSelected * $candidateSelected / 100)+1;
        $data = '0';
        foreach($candidateSet as $c)
        {
            $candidateSelected -= 1;
            if ($candidateSelected == 0)
            {
                $data = $c->id;
            }
        }

        //$data = $candidateSet->first()->id;


        return [
            'data' => $data, //Str::random(10)
            'user_id' => 1,
            'election_id' => $electionSelected,
            'created_at' => now(), // password
            'updated_at' => now(),
        ];
    }
}
