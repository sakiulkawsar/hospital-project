@extends('doctor.main')

@section('main')
<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-info text-white d-flex justify-content-between">
            <h5 class="mb-0">My Appointments</h5>

            <span class="badge bg-dark">
                Total: {{ $appointments->count() }}
            </span>
        </div>

        <div class="card-body">

            <form method="GET" class="mb-3">
                <div class="row g-2">

                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>

                            <option value="Confirmed"
                                {{ request('status') == 'Confirmed' ? 'selected' : '' }}>
                                Confirmed
                            </option>

                            <option value="Completed"
                                {{ request('status') == 'Completed' ? 'selected' : '' }}>
                                Completed
                            </option>
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

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm text-center align-middle">

                    <thead class="table-info">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Specialty</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Email</th>
                            <th>Status</th>
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
                                {{ Str::limit($appointment->message, 40) }}
                            </td>

                            <td>
                              <div class="d-flex justify-content-between align-items-center mb-4">
        
        <a href="{{ route('mail',$appointment->id) }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Email
        </a>
    </div></td>

                           
                            <td>
                                <span class="badge 
                                    @if($appointment->status == 'Confirmed') bg-success
                                    @elseif($appointment->status == 'Completed') bg-primary
                                    @else bg-secondary
                                    @endif
                                ">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted">
                                No Appointment Found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
@endsection
