<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Http\Requests\StoreElectionRequest;
use App\Http\Requests\UpdateElectionRequest;
use App\Models\Election;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use RealRashid\SweetAlert\Facades\Alert;

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
        //should prolly remove this
        if (! Gate::allows('edit-election', $election)) {
            abort(403);
        }
        switch($election->system->value){
            case "irv": //Instant Runoff
                //TODO: Put values in Universal tab JSON
                //TODO: Run that file through a python script that
                //      will send GET requests to the RCVis REST API
                //TODO: embed the retrieved vis into the web page

                //Threshold = droop quota
                //Create JSON File -- writes to /election-simulator/public for some reason
                $myfile = fopen("roundsUniversal.JSON", "w") or die("Unable to open file!");

                fwrite($myfile, "{\n");
                //-------------CONFIG--------------
                fwrite($myfile, "  \"config\" : {\n");

                $txt = "    \"contest\" : \"" . $election->name . "\",\n"; 
                fwrite($myfile, $txt); //contest
                $txt = "    \"date\" : \"" . substr($election->start_at, 0, 10) . "\",\n"; 
                fwrite($myfile, $txt); //date
                $txt = "    \"jurisdiction\" : \"Sample Data\",\n"; 
                fwrite($myfile, $txt); //jurisdiction
                $txt = "    \"office\" : \"Council\",\n"; 
                fwrite($myfile, $txt); //office
                $droop = floor(($election->votes()->count())/2) + 1;
                $threshold = "    \"threshold\" : " . $droop . "\n"; 
                fwrite($myfile, $threshold); //threshold

                fwrite($myfile, "  },\n");
                //------------RESULTS--------------
                fwrite($myfile, "  \"results\" : [ {\n");
                //$currCands = $election->candidates()->get()->toArray();
                //for simplicity, # of rounds = # of candidates - 1
                for ($elimdCands = 0; $elimdCands < $election->candidates()->count()-1; $elimdCands++){
                    $txt = "    \"round\" : " . $elimdCands + 1 . ".0,\n"; 
                    fwrite($myfile, $txt); //round number
                    fwrite($myfile, "    \"tally\" : {\n"); //begin tally
                    $j = 0;
                    foreach($election->candidates()->get() as $candidate){
                        if($j == $election->candidates()->get()->count() - 1){break;}
                        //calc tally
                        $tally = 5.0;
                        //"SELECT count(*) FROM votes WHERE election_id = 7 AND data LIKE '15:%'"; 
                        $lowest = 0;
                        $eliminated = "";
                        $txt = "      \"" . $candidate->name . "\" : " . $tally . ".0"; 
                        $txt .= ($j == count($election->candidates()->get()) - 1) ? "\n" : ",\n";
                        fwrite($myfile, $txt); //candidate tally
                        $j++;
                    }
                    fwrite($myfile, "    },\n"); //end tally

                    fwrite($myfile, "    \"tallyResults\" : [ {\n"); //begin tallyResults
                    $txt = "      \"eliminated\" : " . $eliminated . "\n"; 
                    fwrite($myfile, $txt); //elimanated
                    $txt = "      \"transfers\" : {\n"; //begin transfers
                        foreach($election->candidates()->get() as $candidate){
                            if($j == $election->candidates()->get()->count()) {break;}
                            $tally = 5; //temp value, will need to calculate
                            $lowest = 0;
                            $eliminated = "";
                            $txt = "      \"" . $candidate->name . "\" : " . $tally . ".0"; 
                            $txt .= ($j == $election->candidates()->get()->count()  - 1) ? "\n" : ",\n";
                            fwrite($myfile, $txt); //candidate tally
                            $j++;
                        }
                    $txt = "      }\n"; //end transfers
                    fwrite($myfile, $txt); //elimanated
                    fwrite($myfile, "    } ]\n");
                    //eliminate candidate (will break with duplicate names)
                    //unset($currCands[array_search($eliminated, $currCands)]);
                }
                fwrite($myfile, "  },\n"); //end round
                fwrite($myfile, "  ]\n");//end results
                fwrite($myfile, "}");//end file
                fclose($myfile);
                
                break;
            default: //First Past The post

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
                                // ->setColors(['#000000', '#333333', '#666666', '#999999', '#CCCCCC', '#FFFFFF',])
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
                                ->setMarkers(['#FF5722', '#E040FB'], 7, 10)
                                // ->setGrid(false, '#3F51B5', 0.1)
                                ->setXAxis($arrName);

                return view('elections.show', compact('election', 'pie', 'barChart', 'arrName', 'arrVotes'));
        }
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
