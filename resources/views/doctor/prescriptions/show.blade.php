@extends('doctor.main')
<base href="/public">
@section('main')

<div class="page-section">
    <div class="container">
        <h1 class="text-center mb-5">Prescription Details</h1>

        {{-- Appointment Info --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Appointment Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Patient Name:</strong> {{ $prescription->appointment->full_name }}</p>
                <p><strong>Specialty:</strong> {{ $prescription->appointment->specialty->specialty_name ?? 'N/A' }}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($prescription->appointment->submission_date)->format('d M Y') }}</p>
            </div>
        </div>

        {{-- Medicines --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Medicines</h5>
            </div>
            <div class="card-body">
                @foreach($prescription->medicines as $index => $medicine)
                    <div class="border rounded p-3 mb-3">
                        <h6 class="fw-bold">Medicine #{{ $index + 1 }}</h6>
                        <p><strong>Name:</strong> {{ $medicine->name }}</p>
                        <p><strong>Dose:</strong> {{ $medicine->dose }}</p>
                        <p><strong>Time:</strong> {{ $medicine->time }}</p>
                        <p><strong>Duration:</strong> {{ $medicine->duration }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Notes --}}
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Notes</h5>
            </div>
            <div class="card-body">
                {{ $prescription->notes ?? 'No additional notes.' }}
            </div>
        </div>

        <div class="text-end">
            <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('prescriptions.edit', $prescription->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
</div>

@endsection
