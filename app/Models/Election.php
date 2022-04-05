<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\VotingSystem;

/**
 * VoteController Class functions to create, edit, and store
 * votes in the mySQL database directly interacting with:
 * 
 * Interactions:
 *      app/Model/Vote.php -> check user owner & related elections
 *          -user()
 *          -election()
 *
 *      database/factories/VoteFactory.php -> references standard vote schema and generation during database seeding
 *          -/database/seeder/DatabaseSeeder.php calls: \App\Models\Vote::factory(n)->create();
 * 
 * Vote Schema:
 *      Vote -> [id, name, description, system, public, anonymous, start_at, end_at, owner_id, created_at, updated_at]
 *          id          -> unique vote id integer
 *          name        -> unique string identifier related to the name of the election
 *          description -> string description of the election given by user in election creation or election editior
 *          system      -> string to define election type (FPTP(single choice voting) /IRV(ranked choice))
 *          public      -> boolean identifier to define if it can be seen by all users
 *          anonymous   -> boolean identifier to define whether or not the election can be queried for users by vote
 *          start_at    -> time id for when voting begins in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 *          end_at      -> time id for when voting ends in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 *          election_id -> unique id SQL index of the election to which this vote relates
 *          created_at  -> time id for when the vote was cast in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 *          updated_at  -> time id for the last time the vote was edited in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 */

class Election extends Model
{
    use HasFactory;

    protected $casts = [
        'system' => VotingSystem::class,
        'start_at' => 'datetime:Y-m-d',
        'end_at' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
