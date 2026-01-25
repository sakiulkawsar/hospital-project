<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;

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
    public function viewDoctors(){
        $doctors=Doctor::all();
        return view('admin.view_doctors',compact('doctors'));
    }
    public function deleteDoctor($id){
        $doctor = Doctor::findOrFail($id);

        $doctor->delete();
        return redirect()->back();
    }

     public function updateDoctor($id){
        $doctor = Doctor::findOrFail($id);

      
        return view('admin.update_doctors', compact('doctor'));
    }

    public function postUpdateDoctors(Request $request, $id){
        $doctor = Doctor::findOrFail($id);
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

            return redirect()->back()->with('success', 'Doctor update successfully');

    }
   public function viewAppointment(){
    $appointments = Appointment::with('specialty', 'doctor')
                    ->orderBy('submission_date', 'desc')
                    ->get();
    return view('admin.view_appointment', compact('appointments'));
    }

     public function changeStatus(Request $request, $id){
        $appointments = Appointment::findOrFail($id); 

         $appointments-> status=$request->status;
         $appointments->save();
         return redirect()->back();
     }
}
