<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;


class userController extends Controller
{
    public function Dashboard(){
        if(Auth::check()&&Auth::user()->user_type=='user')
            {
              return view('dashboard');
            }
           else if(Auth::check()&&Auth::user()->user_type=='admin')
            {
              return view('admin.dashboard');
            }
            else{
                return redirect('/');
            }
        
    }
   public function Index() {
    $doctors = Doctor::all();
    return view('index',compact('doctors'));
}

   public function allDoctors() {
    $doctors = Doctor::all();
    return view('doctors',compact('doctors'));
}

public function Appointment(Request $request)
{
    $appointment = new Appointment();

    $appointment->full_name = $request->full_name;
    $appointment->email_address = $request->email_address;
    $appointment->submission_date = $request->submission_date;
    $appointment->specialty = $request->specialty;
    $appointment->number = $request->number;
    $appointment->message = $request->message;

    $appointment->save();

    return redirect()->back()->with('appointment_message', 'Appointment submitted successfully!');
}


public function contact()
{
    return view ('contact');
}


public function appointments(){
    return view('appointment');
}

}
