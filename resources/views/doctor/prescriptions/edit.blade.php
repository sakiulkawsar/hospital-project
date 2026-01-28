@extends('doctor.main')
<base href="/public">
@section('main')

<div class="page-section">
    <div class="container">
        <h1 class="text-center mb-5">Edit Prescription</h1>

        <form action="{{ route('prescriptions.update', $prescription->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Appointment --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Appointment Details</h5>
                </div>
                <div class="card-body">
                    <select name="appointment_id" class="form-control" required>
                        @foreach($appointments as $appointment)
                            <option value="{{ $appointment->id }}"
                                {{ $prescription->appointment_id == $appointment->id ? 'selected' : '' }}>
                                {{ $appointment->full_name }} -
                                {{ $appointment->specialty->specialty_name ?? 'N/A' }} -
                                {{ \Carbon\Carbon::parse($appointment->submission_date)->format('d M Y') }}
                            </option>
                        @endforeach
                    </select>
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

                            <input type="text" name="medicines[{{ $index }}][name]"
                                   class="form-control mb-2"
                                   value="{{ $medicine->name }}" required>

                            <input type="text" name="medicines[{{ $index }}][dose]"
                                   class="form-control mb-2"
                                   value="{{ $medicine->dose }}" required>

                            <input type="text" name="medicines[{{ $index }}][time]"
                                   class="form-control mb-2"
                                   value="{{ $medicine->time }}" required>

                            <input type="text" name="medicines[{{ $index }}][duration]"
                                   class="form-control"
                                   value="{{ $medicine->duration }}" required>
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
                    <textarea name="notes" rows="4" class="form-control">{{ $prescription->notes }}</textarea>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
