<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\Team;

class DashboardController extends Controller
{
    public function index()
    {
        $matches = Match::with('teams')->get();
        $teams = Team::with('matches')->get();

        return view('dashboard', compact(['matches', 'teams']));
    }
}
