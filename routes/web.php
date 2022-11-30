<?php

use App\Models\Programa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\VartotojasController;

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


//Route::view('/', 'welcome');
//Route::view('/programa/{id}', 'welcome');
//Route::view('/login', 'welcome');
//Route::view('/register', 'welcome');

Route::get('{any}', function () {
    return view('welcome');
})->where('any','.*');

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/programa/{id}', [ProgramController::class, 'singleProgramIndex']);
//Route::get('/admin', [VartotojasController::class, 'index']);

//Route::resource('programos', 'ProgramController');
