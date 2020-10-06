<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMatchRequest;
use App\Models\Match;
use App\Models\Team;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();

        return view('match_create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatchRequest $request)
    {
        $validatedData = $request->validated();
        $homeTeam = Team::where('slug', strtoupper($validatedData['home-team']))->first();
        $awayTeam = Team::where('slug', strtoupper($validatedData['away-team']))->first();

        $match = Match::create([
            'played_at' => $validatedData['played-at'],
            'slug' => strtoupper($homeTeam->slug . $awayTeam->slug)
        ]);

        $match->teams()->attach($homeTeam->id, ['is_home' => 1, 'goals' => $validatedData['home-team-goals']]);
        $match->teams()->attach($awayTeam->id, ['is_home' => 0, 'goals' => $validatedData['away-team-goals']]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function show(Match $match)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Match $match)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function destroy(Match $match)
    {
        //
    }
}
