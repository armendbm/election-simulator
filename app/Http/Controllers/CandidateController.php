<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Models\Candidate;
use App\Models\Election;

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

class CandidateController extends Controller
{
    /**
     * Within edit-election page, new candidate is added and
     * stored within the MySQL candidates page. Once the
     * user presses 'add candidate' CandidateController.store($req, $elec)
     * is called and refreshes the edit-election screen to display newly
     * added candidate
     *
     * @param  \App\Http\Requests\StoreCandidateRequest  $request
     * @return \Illuminate\Http\Response
     */
    /* public function store(StoreCandidateRequest $request) */
    public function store(Request $request, Election $election)
    {
        if (! Gate::allows('edit-election', $election)) {
            abort(403);
        }

        $candidate = new Candidate;
        $candidate->name = $request->name;
        $candidate->description = $request->description;
        $election->candidates()->save($candidate);

        return redirect(route('elections.edit', ['election' => $election->id]));
    }

    /**
     * Within edit-election page, candidates are deleted given $candidate
     * is a member of the $election given as arguments
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Election $election, Candidate $candidate)
    {
        if (! Gate::allows('edit-election', $election)) {
            abort(403);
        }

        $candidate->delete();
        return redirect(route('elections.edit', ['election' => $election->id]));
    }
}
