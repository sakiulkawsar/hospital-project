<?php

namespace App\Http\Controllers;

use App\Models\MedicalTest;
use Illuminate\Http\Request;



class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {    
        // dd(Test::all());
        // return view('doctor.addTest');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(MedicalTest $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalTest $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalTest $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalTest $test)
    {
        //
    }
}
