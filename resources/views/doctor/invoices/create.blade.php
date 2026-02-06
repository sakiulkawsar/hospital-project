@extends('doctor.main')
<base href="/public">

@section('main')

<div class="container">
    <h2>Create Invoice</h2>

    <form action="{{ route('invoice.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Patient Name</label>
            <input type="text" name="patients_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="patients_phone" class="form-control">
        </div>

        <div class="mb-3">
            <label>Problem</label>
            <input type="text" name="problem" class="form-control">
        </div>

        <div class="mb-3">
            <label>Test Name</label>
            <input type="text" name="test_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Amount</label>
            <input type="number" name="amount" class="form-control">
        </div>

        <button class="btn btn-success">Save Invoice</button>
    </form>
</div>

@endsection
