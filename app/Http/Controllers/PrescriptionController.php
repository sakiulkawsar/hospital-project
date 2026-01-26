<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
        $prescriptions = Prescription::latest()->get();
        return view('doctor.prescriptions.index', compact('prescriptions'));
    }

       public function pdf(Prescription $prescription)
    {
        $pdf = Pdf::loadView('doctor.prescriptions.pdf', compact('prescription'));
        return $pdf->download('Prescription_'.$prescription->id.'.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        return view('doctor.prescriptions.create', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
