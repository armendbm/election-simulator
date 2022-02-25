<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\result_handler;
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
    return view('documentation', ['resultHandler' => new result_handler()]);
})->name('documentation');

Route::get('delete/{id}', [UserController::class,'delete']);
Route::get('update/{id}', [UserController::class,'update']);
Route::get('updatepassword/{id}', [UserController::class,'updatePassword']);
Route::post('edit/', [UserController::class,'edit']);

require __DIR__.'/auth.php';