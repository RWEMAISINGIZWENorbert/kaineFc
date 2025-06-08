<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::withCount('players')->get();
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:positions',
            'short_name' => 'required|string|max:10',
            'description' => 'nullable|string',
            'category' => 'required|in:forward,midfielder,defender,goalkeeper',
        ]);

        Position::create($validated);
        return redirect()->route('positions.index')->with('success', 'Position created successfully.');
    }

    public function show($id)
    {
        $position = Position::with('players')->findOrFail($id);
        return view('positions.show', compact('position'));
    }

    public function edit($id)
    {
        $position = Position::findOrFail($id);
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
        $position = Position::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:positions,name,' . $id,
            'short_name' => 'required|string|max:10',
            'description' => 'nullable|string',
            'category' => 'required|in:forward,midfielder,defender,goalkeeper',
        ]);

        $position->update($validated);
        return redirect()->route('positions.index')->with('success', 'Position updated successfully.');
    }

    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Position deleted successfully.');
    }
} 