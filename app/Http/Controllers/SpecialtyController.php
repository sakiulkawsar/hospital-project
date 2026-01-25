<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display all specialties
     */
    public function index()
    {
        $specialties = Specialty::latest()->get();
        return view('admin.specialties.index', compact('specialties'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.specialties.create');
    }

    /**
     * Store new specialty
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:specialties,name',
            'description' => 'nullable|string',
        ]);

        Specialty::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('specialties.index')
            ->with('success', 'Specialty added successfully');
    }

    /**
     * Show single specialty (optional)
     */
    public function show(Specialty $specialty)
    {
        return view('admin.specialties.show', compact('specialty'));
    }

    /**
     * Show edit form
     */
    public function edit(Specialty $specialty)
    {
        return view('admin.specialties.edit', compact('specialty'));
    }

    /**
     * Update specialty
     */
    public function update(Request $request, Specialty $specialty)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:specialties,name,' . $specialty->id,
            'description' => 'nullable|string',
        ]);

        $specialty->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('specialties.index')
            ->with('success', 'Specialty updated successfully');
    }

    /**
     * Delete specialty
     */
    public function destroy(Specialty $specialty)
    {
        $specialty->delete();

        return redirect()
            ->route('specialties.index')
            ->with('success', 'Specialty deleted successfully');
    }
}
