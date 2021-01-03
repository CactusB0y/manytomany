<?php

use App\Http\Controllers\MatiereController;
use App\Models\Matiere;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    $matieres = Matiere::all();
    return view('welcome',compact('matieres'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::post('/attach/{id}', [MatiereController::class, 'attach']);
Route::post('/detach/{id}', [MatiereController::class, 'detach']);
