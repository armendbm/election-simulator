<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Models\Election;
use App\Models\Vote;

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
 *      Vote -> [id, data, user_id, election_id, created_at, updated_at]
 *          id          -> unique vote id integer
 *          user_id     -> unique id SQL index of the user who casted the vote
 *          election_id -> unique id SQL index of the election to which this vote relates
 *          created_at  -> time id for when the vote was cast in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 *          updated_at  -> time id for the last time the vote was edited in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 */
class VoteController extends Controller
{
    /**
     * create calls a routing function in web.php 
     * to reference the VoteController.store($req, $elec)
     * in order to store a newly created vote into the database
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Election $election)
    {
        return view('elections.vote', ['election' => $election]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Referencing Model/Vote.php the vote stores the properties:
     *      Vote -> [id, data, user_id, election_id, created_at, updated_at]
     *
     * @param  \App\Http\Requests\StoreVoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    /* public function store(StoreVoteRequest $request) */
    public function store(Request $request, Election $election)
    {
        $vote = new Vote;
        $vote->data = $request->vote;
        $vote->user_id = $request->user()->id;
        $election->votes()->save($vote);
        return redirect(route('dashboard'));
    }
}
