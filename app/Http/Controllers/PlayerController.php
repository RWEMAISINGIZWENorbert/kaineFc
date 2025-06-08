<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Position;
use App\Models\Team;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::with(['position', 'team'])->paginate(10);
        $teams = Team::all();
        $positions = Position::all();
        return view('players.index', compact('players', 'teams', 'positions'));
    }

    public function create()
    {
        $positions = Position::all();
        $teams = Team::all();
        return view('players.create', compact('positions', 'teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'position_id' => 'nullable|exists:positions,id',
            'team_id' => 'nullable|exists:teams,id',
            'jersey_number' => 'required|integer|unique:players',
            'nationality' => 'required|string|max:255',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'contract_start' => 'required|date',
            'contract_end' => 'required|date',
            'medical_conditions' => 'nullable|string',
            'profile_image' => 'nullable|image|max:1024',
        ]);

        // Set position_id and team_id to null if not provided
        $validated['position_id'] = $request->input('position_id') ?: null;
        $validated['team_id'] = $request->input('team_id') ?: null;

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('players', 'public');
        }

        Player::create($validated);
        return redirect()->route('players.index')->with('success', 'Player created successfully.');
    }

    public function show($id)
    {
        $player = Player::with(['position', 'team'])->findOrFail($id);
        return view('players.show', compact('player'));
    }

    public function edit($id)
    {
        $player = Player::findOrFail($id);
        $positions = Position::all();
        $teams = Team::all();
        return view('players.edit', compact('player', 'positions', 'teams'));
    }

    public function update(Request $request, $id)
    {
        $player = Player::findOrFail($id);
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'position_id' => 'required|exists:positions,id',
            'team_id' => 'required|exists:teams,id',
            'jersey_number' => 'required|integer|unique:players,jersey_number,' . $id,
            'nationality' => 'required|string|max:255',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'contract_start' => 'required|date',
            'contract_end' => 'required|date',
            'medical_conditions' => 'nullable|string',
            'profile_image' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('players', 'public');
        }

        $player->update($validated);
        return redirect()->route('players.index')->with('success', 'Player updated successfully.');
    }

    public function destroy($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();
        return redirect()->route('players.index')->with('success', 'Player deleted successfully.');
    }

    // Add player management methods here
} 