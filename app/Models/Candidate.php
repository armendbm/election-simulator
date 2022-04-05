<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * CandidateController Class functions to create, edit, and store
 * votes in the mySQL database directly interacting with:
 * 
 * Interactions:
 *      app/Model/Candidate.php -> check user owner & related elections
 *          -election()
 *      edit-election.blade.php -> for all creation & destruction functions
 * 
 * Candidate Schema:
 *      Candidate -> [id, name, description, election_id, created_at, updated_at]
 *          id          -> unique vote id integer
 *          name        -> string identifier for candidate in election
 *          description -> stores user inputed description as string
 *          election_id -> unique id SQL index of the election to which this vote relates
 *          created_at  -> time id for when the vote was cast in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 *          updated_at  -> time id for the last time the vote was edited in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 */

class Candidate extends Model
{
    use HasFactory;

    /**
     * Returns the election the candidate belongs to. returns type::Election
     * who the given candidate belongs
     */
    public function election()
    {
        return $this->belongsTo(Election::class);
    }
}
