<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Specialty;

class userController extends Controller
{
    public function Dashboard(){
        if(Auth::check()&&Auth::user()->user_type=='user')
            {
              return view('user.dashboard');
            }
           else if(Auth::check()&&Auth::user()->user_type=='admin')
            {
              return view('admin.dashboard');
            }
               else if(Auth::check()&&Auth::user()->user_type=='doctor')
            {
              return view('doctor.dashboard');
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
    $request->validate([
        'full_name'     => 'required|string|max:255',
        'email_address' => 'required|email|max:255',
        'submission_date' => 'required|date',
        'specialty_id'  => 'required|exists:specialties,id',
        'number'        => 'required|string|max:20',
        'message'       => 'required|string|max:1000',
    ]);

    $appointment = new Appointment();

    $appointment->full_name = $request->full_name;
    $appointment->email_address = $request->email_address;
    $appointment->submission_date = $request->submission_date;
    $appointment->specialty_id = $request->specialty_id;
    $appointment->number = $request->number;
    $appointment->message = $request->message;

    $appointment->save();

    return redirect()->back()->with('appointment_message', 'Appointment submitted successfully!');
}


public function contact()
{
    return view ('contact');
}


public function appointments()
{
    $specialties = Specialty::all();

    return view('appointment', compact('specialties'));
}

public function about(){
    return view('about');
}

}
