<?php

use Illuminate\Support\Facades\Route;

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
    if(!fileExists($nav_path = file_get_contents(resource_path("html/navbar.html")))){  ddd('file does not exist');  } 

    return view('welcome', [
        'navbar' => $nav_path
    ]);
});

Route::get('/dashboard', function () {
    if(!fileExists($nav_path = file_get_contents(resource_path("html/navbar.html")))){  ddd('file does not exist');  } 

    return view('dashboard', [
        'navbar' => $nav_path
    ]);
})->middleware(['auth'])->name('dashboard');

Route::get('/documentation', function () {
    return view('documentation');
});

require __DIR__.'/auth.php';
