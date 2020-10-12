<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\Stat;

class DashboardController extends Controller
{
    public function index()
    {
        $matches = Match::with('teams')->get();
        //matches with team relation will be deleted after the stats will be implementd and updated via event listener
        $stats = Stat::all();

        /**sort the collections */
        if (isset($_GET['s'])) {
            $stats->sortBy($_GET['s']);
        } else {
            $matches->sortByDesc('points');
        }

        return view('dashboard', compact(['matches', 'stats']));
    }
}
