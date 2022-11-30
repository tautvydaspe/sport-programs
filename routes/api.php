<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;

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
Route::get('/pagrindiniai_tikslai', [\App\Http\Controllers\PagrindinisProgramosTikslasController::class, 'index']);

Route::prefix('/programa')->group( function() {
    Route::get('/{id}', [ProgramController::class, 'singleProgramIndex']);
    Route::get('/{id}/treneriai', [ProgramController::class, 'singleProgramTrainers']);
    Route::get('/{id}/reviews', [ProgramController::class, 'singleProgramReviews']);
    Route::post('/store', [ProgramController::class, 'store']);
    Route::put('/{id}', [ProgramController::class, 'update']);
    Route::delete('/{id}', [ProgramController::class, 'destroy']);
});

Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);

Route::post('register', [\App\Http\Controllers\RegisterController::class, 'register']);
Route::post('login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\LoginController::class, 'logout']);
//
//Route::prefix('/admin')->group( function() {
//
//});
