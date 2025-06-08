<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchResult;
use App\Models\GameMatch;

class MatchResultController extends Controller
{
    public function index()
    {
        $results = MatchResult::with('match')->get();
        return view('results.index', compact('results'));
    }

    public function create()
    {
        $matches = GameMatch::where('status', 'completed')->get();
        return view('results.create', compact('matches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'match_id' => 'required|exists:game_matches,id',
            'home_team_score' => 'required|integer|min:0',
            'away_team_score' => 'required|integer|min:0',
            'winner' => 'required|in:home,away,draw',
            'match_summary' => 'nullable|string',
            'highlights' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        MatchResult::create($validated);
        return redirect()->route('results.index')->with('success', 'Match result created successfully.');
    }

    public function show($id)
    {
        $result = MatchResult::with('match')->findOrFail($id);
        return view('results.show', compact('result'));
    }

    public function edit($id)
    {
        $result = MatchResult::findOrFail($id);
        $matches = GameMatch::where('status', 'completed')->get();
        return view('results.edit', compact('result', 'matches'));
    }

    public function update(Request $request, $id)
    {
        $result = MatchResult::findOrFail($id);
        $validated = $request->validate([
            'match_id' => 'required|exists:game_matches,id',
            'home_team_score' => 'required|integer|min:0',
            'away_team_score' => 'required|integer|min:0',
            'winner' => 'required|in:home,away,draw',
            'match_summary' => 'nullable|string',
            'highlights' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $result->update($validated);
        return redirect()->route('results.index')->with('success', 'Match result updated successfully.');
    }

    public function destroy($id)
    {
        $result = MatchResult::findOrFail($id);
        $result->delete();
        return redirect()->route('results.index')->with('success', 'Match result deleted successfully.');
    }

    // Add match result management methods here
} 