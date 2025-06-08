<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Player;
use App\Models\Staff;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with(['player', 'staff'])->get();
        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        $players = Player::all();
        $staff = Staff::all();
        return view('attendance.create', compact('players', 'staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'player_id' => 'nullable|exists:players,id',
            'staff_id' => 'nullable|exists:staff,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late,excused',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
            'notes' => 'nullable|string',
        ]);

        // Ensure either player_id or staff_id is provided
        if (empty($validated['player_id']) && empty($validated['staff_id'])) {
            return back()->withErrors(['error' => 'Either player or staff must be selected.']);
        }

        Attendance::create($validated);
        return redirect()->route('attendance.index')->with('success', 'Attendance record created successfully.');
    }

    public function show($id)
    {
        $attendance = Attendance::with(['player', 'staff'])->findOrFail($id);
        return view('attendance.show', compact('attendance'));
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $players = Player::all();
        $staff = Staff::all();
        return view('attendance.edit', compact('attendance', 'players', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);
        $validated = $request->validate([
            'player_id' => 'nullable|exists:players,id',
            'staff_id' => 'nullable|exists:staff,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late,excused',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
            'notes' => 'nullable|string',
        ]);

        // Ensure either player_id or staff_id is provided
        if (empty($validated['player_id']) && empty($validated['staff_id'])) {
            return back()->withErrors(['error' => 'Either player or staff must be selected.']);
        }

        $attendance->update($validated);
        return redirect()->route('attendance.index')->with('success', 'Attendance record updated successfully.');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'Attendance record deleted successfully.');
    }

    // Add attendance management methods here
} 