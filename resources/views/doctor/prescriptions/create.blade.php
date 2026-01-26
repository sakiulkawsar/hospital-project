@extends('doctor.main')
<base href="/public">
@section('main')
<div class="page-section">
    <div class="container">
        <h1 class="text-center mb-4">Create Prescription</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('prescriptions.store') }}" method="POST">
            @csrf

            {{-- Patient --}}
            <div class="mb-3">
                <label for="patient_id" class="form-label">Patient</label>
                <select name="patient_id" id="patient_id" class="form-control" required>
                    <option value="">-- Select Patient --</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->patients_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Medicines --}}
            <div class="mb-3">
                <label for="medicines" class="form-label">Medicines & Instructions</label>
                <textarea name="medicines" id="medicines" rows="5" class="form-control" placeholder="List medicines and instructions" required></textarea>
            </div>

            {{-- Notes --}}
            <div class="mb-3">
                <label for="notes" class="form-label">Additional Notes (Optional)</label>
                <textarea name="notes" id="notes" rows="3" class="form-control" placeholder="Any extra notes"></textarea>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary">Save Prescription</button>
        </form>
    </div>
</div>
@endsection
