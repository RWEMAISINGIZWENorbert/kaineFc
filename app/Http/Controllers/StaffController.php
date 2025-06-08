<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::with(['role', 'department'])->get();
        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        $roles = Role::all();
        $departments = Department::all();
        return view('staff.create', compact('roles', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'department_id' => 'nullable|exists:departments,id',
            'contact_number' => 'required|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'qualifications' => 'nullable|string',
            'hire_date' => 'required|date',
            'profile_image' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('staff', 'public');
        }

        Staff::create($validated);
        return redirect()->route('staff.index')->with('success', 'Staff created successfully.');
    }

    public function show($id)
    {
        $staff = Staff::with(['role', 'department'])->findOrFail($id);
        return view('staff.show', compact('staff'));
    }

    public function edit(Staff $staff)
    {
        $roles = Role::all();
        return view('staff.edit', compact('staff', 'roles'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'contact_number' => 'required|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'qualifications' => 'nullable|string',
            'hire_date' => 'required|date',
            'profile_image' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($staff->profile_image) {
                Storage::disk('public')->delete($staff->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')->store('staff', 'public');
        }

        $staff->update($validated);
        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
    }

    // Add staff management methods here
} 