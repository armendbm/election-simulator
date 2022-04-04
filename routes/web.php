<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\result_handler;
use App\Models\Election;
use function PHPUnit\Framework\fileExists;



//Standard Web Routes ================================
//      
//     *Standard Web routes switch web page
//      views to common pages, more niche
//      web routes exist as view functions
//      called elsewhere, ie election creator
//      will reference election editor pages
//
// ===================================================
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
//Standard Web Routes ================================


//Account Managment Routes ================================
Route::get('delete/{id}', [UserController::class,'delete']);
Route::post('editUserName/', [UserController::class,'editUserName']);
Route::post('editPassword/', [UserController::class,'editPassword']);
Route::post('editEmail/', [UserController::class,'editEmail']);
//Account Managment Routes ================================

//Election Creation Routes ================================
Route::resource('elections', ElectionController::class)->middleware('auth');
Route::resource('elections.candidates', CandidateController::class)->only(['store', 'update', 'destroy'])->middleware('auth');
Route::resource('elections.votes', VoteController::class)->only(['create', 'store'])->middleware('auth');
//Election Creation Routes ================================

require __DIR__.'/auth.php';
