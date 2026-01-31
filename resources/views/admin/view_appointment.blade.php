@extends('admin.maindesign')

@section('main')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Appointment List</h5>

            <span class="badge bg-dark">
                Total: {{ $appointments->count() }}
            </span>
        </div>

        <div class="card-body">

            <form method="GET" class="mb-3">
                <div class="row g-2">

                    <div class="col-md-3">
                        <select name="doctor_id" class="form-select">
                            <option value="">All Doctors</option>

                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}"
                                    {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                    {{ optional($doctor->user)->name ?? 'No Name' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>

                            <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-info text-white">
                            Filter
                        </button>

                        <a href="{{ route('view_appointment') }}" class="btn btn-secondary">
                            Reset
                        </a>
                    </div>

                </div>
            </form>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm align-middle text-center">

                    <thead class="table-info">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Specialty</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Fee</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th style="width:250px;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->full_name }}</td>
                            <td>{{ $appointment->email_address }}</td>
                            <td>{{ $appointment->submission_date }}</td>
                            <td>{{ $appointment->specialty->name ?? '' }}</td>
                            <td>{{ $appointment->number }}</td>

                            <td style="max-width:200px;">
                                <span class="text-muted">
                                    {{ Str::limit($appointment->message, 40) }}
                                </span>
                            </td>

                            <td>
                                <form action="{{ route('process_payment', $appointment->id) }}" method="POST" class="payment-form">
                                    @csrf
                                    <input 
                                        type="number" 
                                        name="fee" 
                                        value="{{ $appointment->fee }}" 
                                        class="form-control form-control-sm fee-input"
                                        step="0.01"
                                        min="0"
                                        {{ $appointment->payment_link ? 'readonly' : '' }}
                                        style="width: 100px; margin: 0 auto;"
                                    >
                                </form>
                            </td>

                            <td>
                                <form action="{{ route('process_payment', $appointment->id) }}" method="POST" class="payment-form">
                                    @csrf
                                    <input type="hidden" name="fee" value="{{ $appointment->fee }}" class="hidden-fee">

                                    <div class="d-flex flex-column gap-1">
                                        @if($appointment->payment_link)
                                            <button 
                                                type="button" 
                                                class="btn btn-sm btn-success copy-link-btn"
                                                data-link="{{ $appointment->payment_link }}"
                                                onclick="copyPaymentLink(this)"
                                            >
                                                <i class="fas fa-copy"></i> Copy Link
                                            </button>

                                            @php
                                                $latestPayment = $appointment->payments()->latest()->first();
                                            @endphp
                                            @if($latestPayment)
                                                <span class="badge 
                                                    @if($latestPayment->status == 'Paid') bg-success
                                                    @elseif($latestPayment->status == 'Failed') bg-danger
                                                    @else bg-warning text-dark
                                                    @endif
                                                ">
                                                    {{ $latestPayment->status }}
                                                </span>
                                            @endif
                                        @else
                                            <button 
                                                type="submit" 
                                                class="btn btn-sm btn-primary process-payment-btn"
                                            >
                                                <i class="fas fa-dollar-sign"></i> Process Payment
                                            </button>
                                        @endif
                                    </div>
                                </form>
                            </td>

                            <td>
                                <span class="badge 
                                    @if($appointment->status == 'Confirmed') bg-success
                                    @elseif($appointment->status == 'Completed') bg-primary
                                    @elseif($appointment->status == 'Cancelled') bg-danger
                                    @else bg-warning text-dark
                                    @endif
                                ">
                                    {{ $appointment->status }}
                                </span>
                            </td>

                            <td>
                                <form action="{{ route('changestatus', $appointment->id) }}" method="post">
                                    @csrf

                                    <div class="d-flex flex-column gap-1">

                                        <select name="status" class="form-select form-select-sm status-select">
                                            <option value="In Progress" {{ $appointment->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>

                                        <select name="doctor_id" class="form-select form-select-sm doctor-select">
                                            <option value="">Select Doctor</option>

                                            @foreach($doctors as $doctor)
                                                <option value="{{ $doctor->id }}"
                                                    {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                                    {{ optional($doctor->user)->name ?? 'No Name' }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <button class="btn btn-sm btn-primary">
                                            Update
                                        </button>

                                    </div>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-muted">No Appointment Found</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<script>
document.querySelectorAll('.status-select').forEach(function(select){

    function toggleDoctor(select){
        let doctorSelect = select.closest('form').querySelector('.doctor-select');

        if(select.value === 'Confirmed' || select.value === 'Completed'){
            doctorSelect.style.display = 'block';
        } else {
            doctorSelect.style.display = 'none';
        }
    }

    toggleDoctor(select);

    select.addEventListener('change', function(){
        toggleDoctor(select);
    });
});

document.querySelectorAll('.fee-input').forEach(function(input){
    input.addEventListener('input', function(){
        let form = this.closest('tr').querySelector('.payment-form');
        let hiddenFee = form.querySelector('.hidden-fee');
        if(hiddenFee) {
            hiddenFee.value = this.value;
        }
    });
});

function copyPaymentLink(button) {
    const link = button.getAttribute('data-link');
    
    const tempInput = document.createElement('input');
    tempInput.value = link;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
    
    const originalHTML = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check"></i> Copied!';
    button.classList.remove('btn-success');
    button.classList.add('btn-info');
    
    setTimeout(function(){
        button.innerHTML = originalHTML;
        button.classList.remove('btn-info');
        button.classList.add('btn-success');
    }, 2000);
}

setTimeout(function(){
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert){
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    });
}, 5000);
</script>

@endsection