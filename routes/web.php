<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\result_handler;
use App\Models\Election;
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

// Below are the Route created for Dashboard ================================
Route::get('delete/{id}', [UserController::class,'delete']);
Route::get('updateUserName/{id}', [UserController::class,'updateUserName']);
Route::post('editUserName/', [UserController::class,'editUserName']);
Route::get('updatePassword/{id}', [UserController::class,'updatePassword']);
Route::post('editPassword/', [UserController::class,'editPassword']);
Route::get('updateEmail/{id}', [UserController::class,'updateEmail']);
Route::post('editEmail/', [UserController::class,'editEmail']);

Route::resource('elections', ElectionController::class)->middleware('auth');
Route::resource('elections.candidates', CandidateController::class)->only(['store', 'update', 'destroy'])->middleware('auth');

require __DIR__.'/auth.php';
