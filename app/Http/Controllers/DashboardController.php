<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\Team;

class DashboardController extends Controller
{
    public function index()
    {
        $matches = Match::all();
        $teams = Team::with('matches')->get();

        return view('dashboard', compact(['matches', 'teams']));
    }
}
