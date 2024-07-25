<?php

namespace App\Http\Controllers;
use App\Models\Season;

use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index()
    {
        $currentSeason = Season::getCurrentSeason();
        return view('seasons.index', compact('currentSeason'));
    }

    public function create()
    {
        return view('seasons.create');
    }

    public function store(Request $request)
    {
        $season = Season::create($request->all());
        return redirect()->route('seasons.index');
    }
}