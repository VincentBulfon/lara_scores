<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TeamController extends Controller
{
    /**
     * save the resized images into the public/images
     * @param array $request a validated request array
     * @return string $newName the name of the created file
     * @throws \Intervention\Image\Exception\InvalidArgumentException
     * @throws \Intervention\Image\Exception\NotSupportedException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Intervention\Image\Exception\NotWritableException
     */
    private function HandleImage(array $request, $newName)
    {
        if ($request['file']) {
            $file = $request['file'];
            //Storage::makeDirectory is important because if you don't create a new directory intervention image doesn't have the permission to create a new directory if the specified path doesn't already exist.
            Storage::makeDirectory('/images/small/');
            //the name of the final file should be provided in the file path refer to exemples at "http://image.intervention.io/api/save" for more infos
            $path = 'storage/images/small/' . $newName;
            $resized = Image::make($file)->resize(50, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode();
            //public path give the full qualified name to the given path in our app
            $resized->save(public_path($path));

            Storage::makeDirectory('/images/big/');
            $path = 'storage/images/big/' . $newName;
            $resized = Image::make($file)->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode();
            $resized->save(public_path($path));
        }
    }

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

        return view('team-create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request)
    {
        //check if the request containt a file
        if ($request->hasFile('file')) {
            $newName = $request->validated()['file']->hashName();
            $this->HandleImage($request->validated(), $newName);
        }
        $slug = mb_strtoupper($request->validated()['slug']);

        Team::create([
            'name' => $request->validated()['name'],
            'slug' => $slug
        ]);
        Team::where('slug', '=', $slug)->first()->images()->create(['file_name' => $newName]);

        return redirect('/team/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
