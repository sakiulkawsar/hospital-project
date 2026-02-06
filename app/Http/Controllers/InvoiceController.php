<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\MedicalTest;

class InvoiceController extends Controller
{
  public function index()
{
    
    $invoices = Invoice::with('medicalTest')->latest()->get();

  
    return view('doctor.invoices.index', compact('invoices'));
}

    public function create()
    {
        return view('doctor.invoices.create');
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

        // Medical Test save
        $test = MedicalTest::create($request->all());

        // Invoice create
        Invoice::create([
            'medical_test_id' => $test->id,
            'patient_name'    => $test->patients_name,
            'patient_phone'   => $test->patients_phone,
            'amount'          => $test->amount,
        ]);

        return redirect()
            ->route('invoice.index')
            ->with('success', 'Invoice created successfully');
    }
}
