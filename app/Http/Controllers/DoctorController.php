<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class DoctorController extends Controller
{
    // Show the form
    public function addPatients()
    {
        return view('doctor.add_patients');
    }

    // Store form data
    public function store(Request $request)
    {

    // dd($request->all());
        // Validate input
        $request->validate([
            'patients_name'  => 'required|string|max:255',
            'patients_phone' => 'required|string|max:20',
            'problem'        => 'required|string|max:255',
            'patient_image'  => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Create new patient
        $patient = new Patient();
        $patient->patients_name  = $request->patients_name;
        $patient->patients_phone = $request->patients_phone;
        $patient->problem        = $request->problem;

        // Handle image upload
        if ($request->hasFile('patient_image')) {
            $image = $request->file('patient_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('patient_images'), $name);

            $patient->patient_image = 'patient_images/' . $name;
        }

        $patient->save();

        return redirect()->back()->with('success', 'Patient added successfully');
    }

    public function viewPatients()
{
    $patients = \App\Models\Patient::all();
    return view('doctor.view_patients', compact('patients'));
}
  public function deletePatient($id){
        $patient = Patient::findOrFail($id);

        $patient->delete();
        return redirect()->back();
    }
     public function updatePatient($id){
        $patient = Patient::findOrFail($id);

      
        return view('doctor.update_patients', compact('patient'));
    }

  public function postUpdatePatient(Request $request, $id)
{
    $patient = Patient::findOrFail($id);

    // ✅ Validation (VERY IMPORTANT)
    $request->validate([
        'patients_name'  => 'required|string|max:255',
        'patients_phone' => 'required|string|max:20',
        'problem'        => 'required|string|max:255',
        'patient_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $patient->patients_name  = $request->patients_name;
    $patient->patients_phone = $request->patients_phone;
    $patient->problem        = $request->problem;

    // ✅ Image update
    if ($request->hasFile('patient_image')) {

        // delete old image (if exists)
        if ($patient->patient_image && file_exists(public_path($patient->patient_image))) {
            unlink(public_path($patient->patient_image));
        }

        $image = $request->file('patient_image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('patient_images'), $name);

        $patient->patient_image = 'patient_images/' . $name;
    }

    $patient->save();

    return redirect()->back()->with('success', 'Patient updated successfully');
}


    }

