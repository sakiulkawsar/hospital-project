<?php

  

namespace App\Http\Controllers;
use App\Models\Appointment;
  

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;


use App\Mail\AppointmentMail;
use Illuminate\Support\Facades\Mail as FacadesMail;

class MailController extends Controller

{

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function index($id)

    {

        $appointment = Appointment::findOrFail($id);

        Mail::to($appointment->email_address)
            ->send(new AppointmentMail($appointment));

        return back()->with('success', 'Appointment email sent successfully.');

    }

}