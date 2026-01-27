<?php

namespace App\Http\Controllers;

use App\Models\MedicalTest;

use Illuminate\Http\Request;

class MedicalTestController extends Controller
{
    public function index()
    {
        $medicalTests = MedicalTest::latest()->get();
        return view('doctor.medicalTests.index', compact('medicalTests'));
    }

    public function create()
    {
        return view('doctor.medicalTests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patients_name'  => 'required|string|max:255',
            'patients_phone' => 'required|string|max:20',
            'problem'        => 'required|string|max:255',
            'test_name'      => 'required|string|max:255',
            'amount'         => 'required|numeric|min:0',
        ]);

        MedicalTest::create($request->all());

        return redirect()
            ->route('medical_tests.index')
            ->with('success', 'Clinical test added successfully');
    }

    public function edit(MedicalTest $medicalTest)
    {
        return view('doctor.medicalTests.edit', compact('medicalTest'));
    }

    public function update(Request $request, MedicalTest $medicalTest)
    {
        $request->validate([
            'patients_name'  => 'required|string|max:255',
            'patients_phone' => 'required|string|max:20',
            'problem'        => 'required|string|max:255',
            'test_name'      => 'required|string|max:255',
            'amount'         => 'required|numeric|min:0',
        ]);

        $medicalTest->update($request->all());

        return redirect()
            ->route('medical_tests.index')
            ->with('success', 'Clinical test updated successfully');
    }

    public function destroy(MedicalTest $medicalTest)
    {
        $medicalTest->delete();

        return redirect()
            ->route('medical_tests.index')
            ->with('success', 'Medical test deleted successfully');
    }
    

}


