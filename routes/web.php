<?php

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
    return redirect("login");
});

Route::get('/dashboard', function () {
    return redirect("candidate");
})->middleware(['auth'])->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::resource("candidate", \App\Http\Controllers\CandidateController::class);
    Route::resource("party", \App\Http\Controllers\PartyController::class);
    Route::resource("portfolio", \App\Http\Controllers\PortfolioController::class);
    Route::resource("election", \App\Http\Controllers\ElectionController::class);
    Route::post("election/activate/single", "\App\Http\Controllers\ElectionController@update_single");
    Route::resource("voter", \App\Http\Controllers\VoterController::class);
    Route::resource("ballot", \App\Http\Controllers\BallotController::class);
    Route::get("result", '\App\Http\Controllers\ElectionController@results');



});
Route::get("api/ballot/cast_vote", '\App\Http\Controllers\ApiController@vote');
Route::get("api/ballot/verify_id", '\App\Http\Controllers\ApiController@verify_id');
Route::resource("api/ballot", \App\Http\Controllers\ApiController::class);

require __DIR__ . '/auth.php';
