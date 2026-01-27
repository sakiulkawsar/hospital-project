@extends('doctor.main')
<base href="/public">
@section('main')
<div class="page-section">
    <div class="container">
        <h1 class="text-center mb-5">Create Prescription</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('prescriptions.store') }}" method="POST" id="prescriptionForm">
            @csrf

            {{-- Appointment Selection --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Appointment Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="appointment_id" class="form-label">Select Appointment <span class="text-danger">*</span></label>
                        <select name="appointment_id" id="appointment_id" class="form-control @error('appointment_id') is-invalid @enderror" required>
                            <option value="">-- Select Appointment --</option>
                            @foreach($appointments as $appointment)
                                <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                    {{ $appointment->full_name }} - 
                                    {{ $appointment->specialty->specialty_name ?? 'N/A' }} - 
                                    {{ \Carbon\Carbon::parse($appointment->submission_date)->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                        @error('appointment_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Display patient info when appointment is selected --}}
                    <div id="patientInfo" class="alert alert-info d-none">
                        <strong>Patient Information:</strong>
                        <p class="mb-0" id="patientDetails"></p>
                    </div>
                </div>
            </div>

            {{-- Medicines Section --}}
            <div class="card mb-4">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Medicines</h5>
                    <button type="button" class="btn btn-light btn-sm" id="addMedicine">
                        <i class="fas fa-plus"></i> Add Medicine
                    </button>
                </div>
                <div class="card-body">
                    <div id="medicinesContainer">
                        {{-- Medicine rows will be added here --}}
                    </div>
                </div>
            </div>

            {{-- Notes Section --}}
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Additional Notes</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes (Optional)</label>
                        <textarea name="notes" id="notes" rows="4" class="form-control @error('notes') is-invalid @enderror" placeholder="Any additional notes or instructions for the patient">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Submit Buttons --}}
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Prescription
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .medicine-row {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
        position: relative;
    }

    .medicine-row .remove-medicine {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .medicine-number {
        font-weight: bold;
        color: #495057;
        margin-bottom: 15px;
        font-size: 1.1rem;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let medicineCount = 0;

    // Add first medicine row on page load
    addMedicineRow();

    // Add medicine button click
    document.getElementById('addMedicine').addEventListener('click', function() {
        addMedicineRow();
    });

    // Function to add medicine row
    function addMedicineRow() {
        medicineCount++;
        const container = document.getElementById('medicinesContainer');
        
        const medicineRow = document.createElement('div');
        medicineRow.className = 'medicine-row';
        medicineRow.innerHTML = `
            <button type="button" class="btn btn-danger btn-sm remove-medicine" onclick="removeMedicine(this)">
                <i class="fas fa-trash"></i> Remove
            </button>
            
            <div class="medicine-number">Medicine #${medicineCount}</div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Medicine Name <span class="text-danger">*</span></label>
                    <input type="text" name="medicines[${medicineCount}][name]" class="form-control" placeholder="e.g., Paracetamol" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Dose <span class="text-danger">*</span></label>
                    <input type="text" name="medicines[${medicineCount}][dose]" class="form-control" placeholder="e.g., 500mg" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Time/Frequency <span class="text-danger">*</span></label>
                    <input type="text" name="medicines[${medicineCount}][time]" class="form-control" placeholder="e.g., 3 times daily after meals" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Duration <span class="text-danger">*</span></label>
                    <input type="text" name="medicines[${medicineCount}][duration]" class="form-control" placeholder="e.g., 7 days" required>
                </div>
            </div>
        `;
        
        container.appendChild(medicineRow);
        updateMedicineNumbers();
    }

    // Remove medicine function
    window.removeMedicine = function(button) {
        const medicineRows = document.querySelectorAll('.medicine-row');
        if (medicineRows.length > 1) {
            button.closest('.medicine-row').remove();
            updateMedicineNumbers();
        } else {
            alert('At least one medicine is required!');
        }
    }

    // Update medicine numbers
    function updateMedicineNumbers() {
        const medicineRows = document.querySelectorAll('.medicine-row');
        medicineRows.forEach((row, index) => {
            row.querySelector('.medicine-number').textContent = `Medicine #${index + 1}`;
        });
    }

    // Appointment selection - show patient info
    document.getElementById('appointment_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const patientInfo = document.getElementById('patientInfo');
        const patientDetails = document.getElementById('patientDetails');
        
        if (this.value) {
            const appointmentText = selectedOption.text;
            patientDetails.textContent = appointmentText;
            patientInfo.classList.remove('d-none');
        } else {
            patientInfo.classList.add('d-none');
        }
    });
});
</script>
@endsection