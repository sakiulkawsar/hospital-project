@extends('doctor.main')
<base href="/public">

@section('main')
<div class="page-section">
    <div class="container">
        <h1 class="text-center wow fadeInUp">Edit Clinical Test</h1>

        <form class="contact-form mt-5"
              action="{{ route('medical_tests.update', $medicalTest->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row mb-3">

                <div class="col-sm-6 py-2">
                    <label>Patient Name</label>
                    <input type="text" name="patients_name"
                           value="{{ old('patients_name', $medicalTest->patients_name) }}"
                           class="form-control">
                </div>

                <div class="col-sm-6 py-2">
                    <label>Patient Phone</label>
                    <input type="text" name="patients_phone"
                           value="{{ old('patients_phone', $medicalTest->patients_phone) }}"
                           class="form-control">
                </div>

                <div class="col-12 py-2">
                    <label>Problem</label>
                    <input type="text" name="problem"
                           value="{{ old('problem', $medicalTest->problem) }}"
                           class="form-control">
                </div>

                <div class="col-12 py-2">
                    <label>Test Name</label>
                    <input type="text" name="test_name"
                           value="{{ old('test_name', $medicalTest->test_name) }}"
                           class="form-control">
                </div>

                <div class="col-12 py-2">
                    <label>Amount</label>
                    <input type="number" name="amount"
                           value="{{ old('amount', $medicalTest->amount) }}"
                           class="form-control">
                </div>

            </div>

            <button type="submit" class="btn btn-primary">
                Update Test
            </button>

        </form>
    </div>
</div>
@endsection
