<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:teams',
            'short_name' => 'required|string|max:10',
            'logo' => 'nullable|image|max:1024',
            'founded_year' => 'required|integer|min:1800|max:' . date('Y'),
            'stadium' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('teams', 'public');
        }

        Team::create($validated);
        return redirect()->route('teams.index')->with('success', 'Team created successfully.');
    }

    public function show($id)
    {
        $team = Team::with(['players', 'homeMatches', 'awayMatches'])->findOrFail($id);
        return view('teams.show', compact('team'));
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:teams,name,' . $id,
            'short_name' => 'required|string|max:10',
            'logo' => 'nullable|image|max:1024',
            'founded_year' => 'required|integer|min:1800|max:' . date('Y'),
            'stadium' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('teams', 'public');
        }

        $team->update($validated);
        return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }

    // Add team management methods here
} 