<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Medicine;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prescriptions = Prescription::with(['appointment.specialty', 'appointment.doctor', 'medicines'])
            ->latest()
            ->get();
        return view('doctor.prescriptions.index', compact('prescriptions'));
    }

    /**
     * Generate PDF for prescription
     */
    public function pdf(Prescription $prescription)
    {
        $prescription->load(['appointment.specialty', 'appointment.doctor', 'medicines']);
        
        $pdf = Pdf::loadView('doctor.prescriptions.pdf', compact('prescription'))
            ->setPaper('a4', 'portrait')
            ->setOption('margin-top', 10)
            ->setOption('margin-right', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 10);
        
        return $pdf->download('Prescription_RX-' . str_pad($prescription->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get appointments that don't have prescriptions yet (optional)
        $appointments = Appointment::with(['specialty', 'doctor'])
            ->whereDoesntHave('prescription')
            ->orderBy('submission_date', 'desc')
            ->get();
        
        // Or get all appointments
        // $appointments = Appointment::with(['patient', 'specialty', 'doctor'])
        //     ->orderBy('submission_date', 'desc')
        //     ->get();

        return view('doctor.prescriptions.create', compact('appointments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'notes' => 'nullable|string',
            'medicines' => 'required|array|min:1',
            'medicines.*.name' => 'required|string|max:255',
            'medicines.*.dose' => 'required|string|max:255',
            'medicines.*.time' => 'required|string|max:255',
            'medicines.*.duration' => 'required|string|max:255',
        ]);

        // Create prescription
        $prescription = Prescription::create([
            'appointment_id' => $validated['appointment_id'],
            'notes' => $validated['notes'],
        ]);

        // Create medicines
        foreach ($validated['medicines'] as $medicineData) {
            $prescription->medicines()->create($medicineData);
        }

        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescription)
    {
        $prescription->load(['appointment', 'medicines']);
        return view('doctor.prescriptions.show', compact('prescription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $prescription)
    {
        $prescription->load(['appointment', 'medicines']);
        $appointments = Appointment::with(['specialty', 'doctor'])
            ->orderBy('submission_date', 'desc')
            ->get();

        return view('doctor.prescriptions.edit', compact('prescription', 'appointments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'notes' => 'nullable|string',
            'medicines' => 'required|array|min:1',
            'medicines.*.name' => 'required|string|max:255',
            'medicines.*.dose' => 'required|string|max:255',
            'medicines.*.time' => 'required|string|max:255',
            'medicines.*.duration' => 'required|string|max:255',
        ]);

        // Update prescription
        $prescription->update([
            'appointment_id' => $validated['appointment_id'],
            'notes' => $validated['notes'],
        ]);

        // Delete old medicines and create new ones
        $prescription->medicines()->delete();
        foreach ($validated['medicines'] as $medicineData) {
            $prescription->medicines()->create($medicineData);
        }

        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription deleted successfully!');
    }
}