@extends('doctor.main')
@section('main')
<div class="container mt-4">
    <h2>All Invoices</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Patient Name</th>
                <th>Phone</th>
                <th>Test Name</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>

      <tbody>
@foreach($invoices as $invoice)
<tr>
    <td>{{ $invoice->id }}</td>
    <td>{{ $invoice->patient_name }}</td>
    <td>{{ $invoice->patient_phone }}</td>
    <td>{{ $invoice->medicalTest->test_name ?? 'N/A' }}</td>
    <td>{{ $invoice->amount }}</td>
    <td>{{ $invoice->created_at->format('d-M-Y') }}</td>
</tr>
@endforeach
</tbody>
    </table>
</div>
@endsection
