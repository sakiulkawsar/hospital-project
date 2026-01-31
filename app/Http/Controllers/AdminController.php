<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function addDoctors()
    {
        $users = User::all(); // Pass all users for assigning
        return view('admin.add_doctors', compact('users'));
    }

    public function postAddDoctors(Request $request)
    {
        $request->validate([
            'doctors_phone' => 'required|string|max:20',
            'specialty' => 'required|string|max:255',
            'room_number' => 'required|string|max:50',
            'user_id' => 'required|exists:users,id',
            'doctor_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $doctor = new Doctor();
        $doctor->doctors_phone = $request->doctors_phone;
        $doctor->specialty     = $request->specialty;
        $doctor->room_number   = $request->room_number;
        $doctor->user_id       = $request->user_id; // Assign user to doctor

        if ($request->hasFile('doctor_image')) {
            $image = $request->file('doctor_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('doctor_images'), $name);
            $doctor->doctor_image = 'doctor_images/' . $name;
        }

        $doctor->save();

        return redirect()->back()->with('success', 'Doctor added successfully');
    }

    public function viewDoctors()
    {
        $doctors = Doctor::with('user')->get(); // eager load user
        return view('admin.view_doctors', compact('doctors'));
    }
    public function deleteDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);

        $doctor->delete();
        return redirect()->back();
    }

    public function updateDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $users = User::all();
        return view('admin.update_doctors', compact('doctor', 'users'));
    }

    public function postUpdateDoctors(Request $request, $id)
    {
        $request->validate([
            'doctors_phone' => 'required|string|max:20',
            'specialty' => 'required|string|max:255',
            'room_number' => 'required|string|max:50',
            'user_id' => 'required|exists:users,id',
            'doctor_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->doctors_phone = $request->doctors_phone;
        $doctor->specialty     = $request->specialty;
        $doctor->room_number   = $request->room_number;
        $doctor->user_id       = $request->user_id;

        if ($request->hasFile('doctor_image')) {
            $image = $request->file('doctor_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('doctor_images'), $name);
            $doctor->doctor_image = 'doctor_images/' . $name;
        }

        $doctor->save();

        return redirect()->back()->with('success', 'Doctor updated successfully');
    }

    public function viewAppointment(Request $request)
    {
        $user = auth()->user();

        if (!in_array($user->user_type, ['admin', 'doctor'])) {
            abort(403, 'Unauthorized');
        }

        if ($user->user_type === 'admin') {

            $query = Appointment::with(['specialty', 'doctor', 'payments']);

            // Doctor filter
            if ($request->filled('doctor_id')) {
                $query->where('doctor_id', $request->doctor_id);
            }

            // Status filter
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $appointments = $query
                ->orderBy('submission_date', 'desc')
                ->get();

            $doctors = Doctor::all();

            return view('admin.view_appointment', compact('appointments', 'doctors'));
        }

        elseif ($user->user_type === 'doctor') {

            $doctor = Doctor::where('user_id', $user->id)->first();

            $query = Appointment::with('specialty')
                ->where('doctor_id', $doctor->id)
                ->whereIn('status', ['Confirmed', 'Completed']);

            // Optional filter
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $appointments = $query
                ->orderBy('submission_date', 'desc')
                ->get();

            return view('doctor.view_appointment', compact('appointments'));
        }
    }

    public function changeStatus(Request $request, $id)
    {
        $user = auth()->user();

        if ($user->user_type !== 'admin') {
            abort(403);
        }

        $request->validate([
            'status' => 'required|string',
            'doctor_id' => 'nullable|exists:doctors,id'
        ]);

        $appointment = Appointment::findOrFail($id);

        if (in_array($request->status, ['Confirmed', 'Completed']) && !$request->doctor_id) {
            return redirect()->back()->with('error', 'Doctor is required for this status');
        }

        $appointment->status = $request->status;
        $appointment->doctor_id = $request->doctor_id;

        $appointment->save();

        return redirect()->back()->with('success', 'Appointment updated successfully');
    }


    public function processPayment(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'fee' => 'required|numeric|min:0',
        ]);

        if ($appointment->payment_link) {
            return redirect()->back()->with('error', 'Payment link already generated!');
        }

        // Update fee
        $appointment->fee = $request->fee;
        $appointment->save();

        $store_id = 'hungr697e3bfa956fd';
        $store_passwd = 'hungr697e3bfa956fd@ssl';

        $tran_id = 'APP' . Str::upper(Str::random(8)) . '_' . $appointment->id . '_' . time();

        $post_data = [
            'store_id' => $store_id,
            'store_passwd' => $store_passwd,
            'total_amount' => $appointment->fee,
            'currency' => 'BDT',
            'tran_id' => $tran_id,
            'success_url' => route('payment_success', $appointment->id),
            'fail_url' => route('payment_fail', $appointment->id),
            'cancel_url' => route('payment_cancel', $appointment->id),
            'cus_name' => $appointment->full_name,
            'cus_email' => $appointment->email_address,
            'cus_add1' => 'N/A',
            'cus_city' => 'Dhaka',
            'cus_country' => 'Bangladesh',
            'cus_phone' => $appointment->number,
            'shipping_method' => 'NO',
            'product_name' => 'Appointment Fee',
            'product_category' => 'Service',
            'product_profile' => 'general',
        ];

        try {
            $response = Http::asForm()->post('https://sandbox.sslcommerz.com/gwprocess/v4/api.php', $post_data);

            // Debug response
            $data = $response->json();

            if ($response->successful() && isset($data['GatewayPageURL'])) {

                $appointment->payment_link = $data['GatewayPageURL'];
                $appointment->save();

                Payment::create([
                    'appointment_id' => $appointment->id,
                    'amount' => $appointment->fee,
                    'transaction_id' => $tran_id,
                    'status' => 'Pending',
                    'payment_method' => 'SSLCommerz',
                    'notes' => 'Payment link generated',
                ]);

                return redirect()->back()->with('success', 'Payment link generated successfully!');
            } else {
                return redirect()->back()->with('error', 'SSLCommerz error: ' . json_encode($data));
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
        }
    }


    public function paymentSuccess(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        // Find the payment record
        $payment = Payment::where('appointment_id', $appointment->id)
                          ->where('transaction_id', $tran_id)
                          ->first();

        if ($payment) {
            $payment->status = 'Paid';
            $payment->notes = 'Payment successful via SSLCommerz';
            $payment->save();
        }

        return redirect()->route('appointment')
                        ->with('success', 'Payment completed successfully for appointment ID: ' . $appointment->id);
    }

    public function paymentFail(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $tran_id = $request->input('tran_id');

        $payment = Payment::where('appointment_id', $appointment->id)
                          ->where('transaction_id', $tran_id)
                          ->first();

        if ($payment) {
            $payment->status = 'Failed';
            $payment->notes = 'Payment failed - ' . ($request->input('error') ?? 'Unknown error');
            $payment->save();
        }

        return redirect()->route('appointment')
                        ->with('error', 'Payment failed for appointment ID: ' . $appointment->id);
    }

    public function paymentCancel(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $tran_id = $request->input('tran_id');

        $payment = Payment::where('appointment_id', $appointment->id)
                          ->where('transaction_id', $tran_id)
                          ->first();

        if ($payment) {
            $payment->status = 'Failed';
            $payment->notes = 'Payment canceled by user';
            $payment->save();
        }

        return redirect()->route('appointment')
                        ->with('error', 'Payment canceled for appointment ID: ' . $appointment->id);
    }
}
