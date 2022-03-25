<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\result_handler;
use App\Models\Election;
use App\Models\Vote;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\fileExists;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard', ['elections' => Election::all()]);
})->middleware(['auth'])->name('dashboard');

Route::get('/documentation', function () {
    return view('documentation', ['resultHandler' => new result_handler()]);
})->name('documentation');

Route::get('/votingscreen', function () {
    return view('votingscreen');
})->name('votingscreen');

// Below are the Route created for CustomizedElection ================================
Route::get('/customizedElection', function () {
    $votes = Vote::all();
    $arrLen = count($votes);
    $arrID = array(); 
    for($x=0; $x<sizeof($votes);$x++)
        array_push($arrID,$votes[$x]['id']);
    $arrVotes = array(); 
    for($x=0; $x<sizeof($votes);$x++)
        array_push($arrVotes,(int)$votes[$x]['data']);
    $sum = array_sum($arrVotes);
    $arrVotesPercent = array(); 
    for($x=0; $x<sizeof($votes);$x++)
        array_push($arrVotesPercent,(double)number_format((double)$votes[$x]['data']/$sum * 100, 2, '.', ''));

    $chart = (new LarapexChart)->pieChart()
                    ->setTitle('Pie Chart(%)')
                    ->setDataset($arrVotesPercent)
                    ->setLabels($arrID);

    $chart2 = (new LarapexChart)->horizontalBarChart()
                    ->setTitle('Horizontal Bar Chart(Number of votes)')
                    ->setColors(['#008FFB'])
                    ->setDataset([
                        [
                            'name'  =>  'Votes(Number of votes)',
                            'data'  =>  $arrVotes
                        ]
                    ])
                    ->setXAxis($arrID);
    
    return view('customizedElection', compact('chart', 'chart2', 'votes'));
})->middleware(['auth'])->name('customizedElection');
Route::get('deleteVote/{id}', [VoteController::class,'delete']);
Route::post('editData/', [VoteController::class,'editData']);
Route::post('createData/', [VoteController::class,'createData']);

// Below are the Route created for Dashboard ================================
Route::get('delete/{id}', [UserController::class,'delete']);
Route::get('updateUserName/{id}', [UserController::class,'updateUserName']);
Route::post('editUserName/', [UserController::class,'editUserName']);
Route::get('updatePassword/{id}', [UserController::class,'updatePassword']);
Route::post('editPassword/', [UserController::class,'editPassword']);
Route::get('updateEmail/{id}', [UserController::class,'updateEmail']);
Route::post('editEmail/', [UserController::class,'editEmail']);

Route::resource('elections', ElectionController::class);

require __DIR__.'/auth.php';
