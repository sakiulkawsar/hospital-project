<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class AdminController extends Controller
{
    public function addDoctors(){
        return view('admin.add_doctors');
    }
    public function postAddDoctors(Request $request)
        {
            $doctor = new Doctor();

            $doctor->doctors_name  = $request->doctors_name;
            $doctor->doctors_phone = $request->doctors_phone;
            $doctor->specialty     = $request->specialty;
            $doctor->room_number   = $request->room_number;

            if ($request->hasFile('doctor_image')) {
                $image = $request->file('doctor_image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('doctor_images'), $name);

                $doctor->doctor_image = 'doctor_images/'.$name;
            }

            $doctor->save();

            return redirect()->back()->with('success', 'Doctor added successfully');
    }
}
