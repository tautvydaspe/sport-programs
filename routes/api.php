<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AtsiliepimasController;
use App\Http\Controllers\TrenerisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagrindinisProgramosTikslasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

Route::get('/programos', [\App\Http\Controllers\ProgramController::class, 'index']);
Route::prefix('/programa')->group( function() {
    Route::get('/{id}', [ProgramController::class, 'singleProgramIndex']);
    Route::get('/{id}/treneriai', [ProgramController::class, 'singleProgramTrainers']);
    Route::get('/{id}/reviews', [ProgramController::class, 'singleProgramReviews']);
    Route::post('/review/store', [AtsiliepimasController::class, 'store']);
    Route::delete('/review/delete/{id}', [AtsiliepimasController::class, 'destroy']);
    Route::put('/review/update/{id}', [AtsiliepimasController::class, 'update']);
    Route::post('/store', [ProgramController::class, 'store']);
    Route::put('/{id}', [ProgramController::class, 'update']);
    Route::delete('/{id}', [ProgramController::class, 'destroy']);
});

Route::get('/users', [UserController::class, 'index']);
Route::prefix('/user')->group( function() {
    Route::post('/store', [UserController::class, 'store']);
    Route::delete('/delete/{id}', [UserController::class, 'destroy']);
    Route::put('/update/{id}', [UserController::class, 'update']);
});


Route::get('/trainers', [TrenerisController::class, 'index']);
Route::prefix('/treneris')->group( function() {
    Route::post('/store', [TrenerisController::class, 'store']);
    Route::delete('/delete/{id}', [TrenerisController::class, 'destroy']);
    Route::put('/update/{id}', [TrenerisController::class, 'update']);
});

Route::get('/pagrindiniai_tikslai', [PagrindinisProgramosTikslasController::class, 'index']);
Route::prefix('/pagrindinis_tikslas')->group( function() {
    Route::post('/store', [PagrindinisProgramosTikslasController::class, 'store']);
    Route::delete('/delete/{id}', [PagrindinisProgramosTikslasController::class, 'destroy']);
    Route::put('/update/{id}', [PagrindinisProgramosTikslasController::class, 'update']);
});

Route::post('register', [\App\Http\Controllers\RegisterController::class, 'register']);
Route::post('login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\LoginController::class, 'logout']);
//
//Route::prefix('/admin')->group( function() {
//
//});
