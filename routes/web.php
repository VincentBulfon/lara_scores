<?php

use App\Http\Controllers\MatchController;
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

Route::get(
    '/',
    [App\Http\Controllers\DashboardController::class, 'index']
);

Route::get(
    '/match/create',
    [App\Http\Controllers\MatchController::class, 'create']
)->name('match_create')->middleware(['auth', 'can:create, App\Models\Match']);

Route::post(
    '/match',
    [App\Http\Controllers\MatchController::class, 'store']
)->name('match_store')->middleware(['auth', 'can:create, App\Models\Match']);

Route::get(
    '/team/create',
    [App\Http\Controllers\TeamController::class, 'create']
)->name('team_create')->middleware(['auth', 'can:create, App\Models\Team']);

Route::post(
    '/team',
    [App\Http\Controllers\TeamController::class, 'store']
)->name('team_store')->middleware(['auth', 'can:create, App\Models\Team']);

Route::get(
    '/team/{team:slug}/edit',
    [App\Http\Controllers\TeamController::class, 'edit']
)->name('team_edit')->middleware(['auth', 'can:update,team']);

//Route::resource('/matches', MatchController::class)->middleware(['auth', 'can:store, App\Models\Match']);
//Route::resource('/teams', MatchController::class)->middleware(['auth', 'can:store, App\Models\Team']);
