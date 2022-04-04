<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreElectionRequest;
use App\Http\Requests\UpdateElectionRequest;
use App\Models\Election;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use RealRashid\SweetAlert\Facades\Alert;

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

class ElectionController extends Controller
{
    /**
     * opens election creation page
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('elections.create');
    }

    /**
     * stores vote according to schema defined in database migration tables. 
     * schema described in detail at the top of this file
     *
     * @param  \App\Http\Requests\StoreElectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    /* public function store(StoreElectionRequest $request) */
    public function store(Request $request)
    {
        $election = new Election;
        $election->name = $request->name;
        $election->description = $request->description;
        $election->system = $request->system;
        $election->public = $request->has('public');
        $election->anonymous = $request->has('anonymous');
        $election->start_at = $request->start_at;
        $election->end_at = $request->end_at;
        $request->user()->own_elections()->save($election);

        return redirect(route('elections.edit', ['election' => $election->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function show(Election $election)
    {
        if (! Gate::allows('edit-election', $election)) {
            abort(403);
        }

        $arrName = array();
        $arrVotes = array();
        foreach ($election->candidates()->get() as $candidate) {
            array_push($arrName, $candidate->name);
            array_push($arrVotes, count($election->votes()->where('data', $candidate->id)->get()));
        }
        $sum = array_sum($arrVotes);
        // $arrVotesPercent = array();
        // for($x = 0; $x < count($arrVotes); $x++)
        //     if (!$sum) {
        //         array_push($arrVotesPercent, 0, 1, '.', '');
        //     }
        //     else {
        //         array_push($arrVotesPercent, (double)number_format((double)$arrVotes[$x]/$sum * 100, 2, '.', ''));
        //     }

        $pie = (new LarapexChart)->pieChart()
                        ->setTitle('Proportion of Votes')
                        ->setDataset($arrVotes)
                        ->setFontFamily('Calibri')
                        ->setColors(['#886eaa', '#e690ba', '#ebc0e4', '#fee9ea', '#ffcfb3', '#aef6f7','2f9fb3'])
                        ->setLabels($arrName);

        $barChart = (new LarapexChart)->horizontalBarChart()
                        ->setTitle('Number of Votes')
                        ->setColors(['#008FFB'])
                        ->setDataset([
                            [
                                'name'  =>  'Votes',
                                'data'  =>  $arrVotes
                            ]
                        ])
                        ->setFontFamily('Calibri')
                        ->setColors(['#aaaab5'])
                        ->setMarkers(['#FF5722', '#E040FB'], 7, 10)
                        // ->setGrid(false, '#3F51B5', 0.1)
                        ->setXAxis($arrName);


        return view('elections.show', compact('election', 'pie', 'barChart', 'arrName', 'arrVotes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function edit(Election $election)
    {
        if (! Gate::allows('edit-election', $election)) {
            abort(403);
        }

        return view('elections.edit', ['election' => $election]);
    }

    /**
     * Update the election based on details in edit-election
     *
     * @param  \App\Http\Requests\UpdateElectionRequest  $request
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    /* public function update(UpdateElectionRequest $request, Election $election) */
    public function update(Request $request, Election $election)
    {
        if (! Gate::allows('edit-election', $election)) {
            abort(403);
        }

        $election->name = $request->name;
        $election->description = $request->description;
        $election->system = $request->system;
        $election->public = $request->has('public');
        $election->anonymous = $request->has('anonymous');
        $election->start_at = $request->start_at;
        $election->end_at = $request->end_at;
        $request->user()->own_elections()->save($election);

        return redirect(route('dashboard'));
    }

    /**
     * deletes election from MySQL table, can be done in edit election
     *
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function destroy(Election $election)
    {
        if (! Gate::allows('edit-election', $election)) {
            abort(403);
        }

        $election->delete();
        return redirect(route('dashboard'));
    }
}
