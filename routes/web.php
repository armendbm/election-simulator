<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResultHandler;
use App\Http\Controllers\VoteHandler;
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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/documentation', function () {
    return view('documentation', ['ResultHandler' => new ResultHandler(), 'VoteHandler' => new VoteHandler(), 'now' => now()]);
})->name('documentation');

Route::get('/votingscreen', function () {
    return view('votingscreen');
})->name('votingscreen');

Route::get('delete/{id}', [UserController::class,'delete']);
Route::get('updateUserName/{id}', [UserController::class,'updateUserName']);
Route::post('editUserName/', [UserController::class,'editUserName']);
Route::get('updatePassword/{id}', [UserController::class,'updatePassword']);
Route::post('editPassword/', [UserController::class,'editPassword']);
Route::get('updateEmail/{id}', [UserController::class,'updateEmail']);
Route::post('editEmail/', [UserController::class,'editEmail']);
// Above are the Route created for Dashboard ================================

require __DIR__.'/auth.php';