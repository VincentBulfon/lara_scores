<?php

namespace App\Http\Controllers;

use App\Models\Match;

class DashboardController extends Controller
{
    public function index()
    {
        $matches = Match::with('teams')->get();

        return view('dashboard', compact('matches'));
    }
}
