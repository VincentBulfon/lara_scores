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

Route::get(
    '/',
    [App\Http\Controllers\DashboardController::class, 'index']
);

Route::get(
    '/match/create',
    [App\Http\Controllers\MatchController::class, 'create']
)->name('match_creation')->middleware(['auth']);

Route::post(
    '/match',
    [App\Http\Controllers\MatchController::class, 'store']
)->name('match_store')->middleware(['auth']);

Route::get(
    '/team/create',
    [App\Http\Controllers\TeamController::class, 'create']
)->name('team_creation')->middleware('auth');

Route::post(
    '/team',
    [App\Http\Controllers\TeamController::class, 'store']
)->name('team_store')->middleware('auth');
