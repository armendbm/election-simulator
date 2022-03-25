<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Vote;

class VoteController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        // store all the Vote objects in a list and return it to the view(created by Po)
        $data = Vote::all();
        return view('customizedElection', ['votes'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoteRequest  $request
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoteRequest $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        //
    }

    // Below are the functions created for deleting vote in customized election ==================================================
    function delete($id){
        $data = Vote::findOrFail($id);
        $data->delete();   
        return redirect('customizedElection');
    }

    function editData(Request $req){
        // $this->validate($req, [ 'id' => 'required|unique:votes',
        //                         'data' =>  'required|integer|min:0:votes' ]);
        $this->validate($req, [ 'data' =>  'required|integer|min:-1:votes' ]);
        $data = Vote::find($req->id);
        // $data->id = $req->id;
        $data->data = $req->data;
        $data -> save();
        Alert::success('Success', 'Your information has changed!');
        return redirect('/customizedElection');
    }

    function createData(Request $req){
        $data = new Vote;
        $data->id = $req->id;
        $data->data = $req->data;
        $data->user_id = 1;
        $data->election_id = 1;
        $data->save();
        Alert::success('Success', 'Your information has changed!');
        return redirect('/customizedElection');
    }
}
