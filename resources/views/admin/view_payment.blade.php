@extends('admin.maindesign')

@section('main')

<div class="container-fluid ">
    <div class="row m-0">
        <div class="col-12 p-0">
             <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Prescriptions</h1>
            <a href="{{ route('view_payment') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add new doctor
            </a>
        </div>

<table class="table table-bordered text-center w-100">
    <thead>
        <tr style="background-color:lightblue;">
            <th>User ID</th>
            <th>Amount</th>
            <th>Transaction_id</th>
            <th>Status</th>
            <th>Payment_method</th>
            <th>Notes</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
        <tr>
            <td>{{ $payment->appointment_id ?? 'Not assigned' }}</td>
            <td>{{ $payment->amount ?? '' }}</td>
            <td>{{ $payment->transaction_id }}</td>
            <td>{{ $payment->status }}</td>
            <td>{{ $payment->payment_method }}</td>
            <td>{{ $payment->notes }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

        </div>
    </div>
</div>

@endsection
