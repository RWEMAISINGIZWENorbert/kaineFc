<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameMatch;
use App\Models\Team;

class GameMatchController extends Controller
{
    public function index()
    {
        $matches = GameMatch::with(['homeTeam', 'awayTeam'])->get();
        return view('matches.index', compact('matches'));
    }

    public function create()
    {
        $teams = Team::all();
        return view('matches.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id',
            'match_date' => 'required|date',
            'venue' => 'required|string|max:255',
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
            'match_type' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        GameMatch::create($validated);
        return redirect()->route('matches.index')->with('success', 'Match created successfully.');
    }

    public function show($id)
    {
        $match = GameMatch::with(['homeTeam', 'awayTeam', 'result'])->findOrFail($id);
        return view('matches.show', compact('match'));
    }

    public function edit($id)
    {
        $match = GameMatch::findOrFail($id);
        $teams = Team::all();
        return view('matches.edit', compact('match', 'teams'));
    }

    public function update(Request $request, $id)
    {
        $match = GameMatch::findOrFail($id);
        $validated = $request->validate([
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id',
            'match_date' => 'required|date',
            'venue' => 'required|string|max:255',
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
            'match_type' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $match->update($validated);
        return redirect()->route('matches.index')->with('success', 'Match updated successfully.');
    }

    public function destroy($id)
    {
        $match = GameMatch::findOrFail($id);
        $match->delete();
        return redirect()->route('matches.index')->with('success', 'Match deleted successfully.');
    }
} 