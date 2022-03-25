<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Http\Requests\StoreElectionRequest;
use App\Http\Requests\UpdateElectionRequest;
use App\Models\Election;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('elections.create');
    }

    /**
     * Store a newly created resource in storage.
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
        //
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
