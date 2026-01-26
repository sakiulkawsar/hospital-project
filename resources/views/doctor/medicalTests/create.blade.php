@extends('doctor.main')
<base href="/public">
@section('main')
<div class="page-section">
    <div class="container">
        <h1 class="text-center wow fadeInUp">Add Clinical Test</h1>

        <form class="contact-form mt-5"
              action="{{ route('medical_tests.store') }}"
              method="POST">
            @csrf

            {{-- ✅ Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ✅ Validation Errors (ALL) --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row mb-3">

                {{-- Patient Name --}}
                <div class="col-sm-6 py-2">
                    <label>Patient Name</label>
                    <input type="text"
                           name="patients_name"
                           value="{{ old('patients_name') }}"
                           class="form-control @error('patients_name') is-invalid @enderror"
                           placeholder="Patient name..">
                    @error('patients_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Patient Phone --}}
                <div class="col-sm-6 py-2">
                    <label>Patient Phone Number</label>
                    <input type="text"
                           name="patients_phone"
                           value="{{ old('patients_phone') }}"
                           class="form-control @error('patients_phone') is-invalid @enderror"
                           placeholder="Patient phone..">
                    @error('patients_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Problem --}}
                <div class="col-12 py-2">
                    <label>Problem</label>
                    <input type="text"
                           name="problem"
                           value="{{ old('problem') }}"
                           class="form-control @error('problem') is-invalid @enderror"
                           placeholder="Enter problem..">
                    @error('problem')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Test Name --}}
                <div class="col-12 py-2">
                    <label>Test Name</label>
                    <input type="text"
                           name="test_name"
                           value="{{ old('test_name') }}"
                           class="form-control @error('test_name') is-invalid @enderror"
                           placeholder="Enter test name..">
                    @error('test_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Amount --}}
                <div class="col-12 py-2">
                    <label>Total Amount</label>
                    <input type="text"
                           name="amount"
                           value="{{ old('amount') }}"
                           class="form-control @error('amount') is-invalid @enderror"
                           placeholder="Enter clinical test amount.."
                           min="0"
                           step="any">
                    @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <button type="submit" class="btn btn-primary wow zoomIn">
                Add Test
            </button>

        </form>
    </div>
</div>
@endsection
