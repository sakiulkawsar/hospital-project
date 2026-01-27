@extends('doctor.main')
<base href="/public">
@section('main')
<div class="page-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Prescriptions</h1>
            <a href="{{ route('prescriptions.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New Prescription
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Doctor</th>
                                <th>Medicines</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($prescriptions as $prescription)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $prescription->appointment->full_name }}</strong><br>
                                    <small class="text-muted">{{ $prescription->appointment->email_address }}</small>
                                </td>
                                <td>{{ $prescription->appointment->doctor->name ?? 'N/A' }}</td>
                                <td>
                                    @if($prescription->medicines->count() > 0)
                                        <ul class="list-unstyled mb-0">
                                            @foreach($prescription->medicines->take(2) as $medicine)
                                                <li>• {{ $medicine->name }} ({{ $medicine->dose }})</li>
                                            @endforeach
                                            @if($prescription->medicines->count() > 2)
                                                <li class="text-muted"><small>+ {{ $prescription->medicines->count() - 2 }} more</small></li>
                                            @endif
                                        </ul>
                                    @else
                                        <span class="text-muted">No medicines</span>
                                    @endif
                                </td>
                                <td>{{ $prescription->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        {{-- View --}}
                                        <a href="{{ route('prescriptions.show', $prescription->id) }}" 
                                           class="btn btn-sm btn-info" 
                                           
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                            <p>View</p>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('prescriptions.edit', $prescription->id) }}" 
                                           class="btn btn-sm btn-warning" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                            <p>Edit</p>
                                        </a>

                                        {{-- Download PDF --}}
                                        <a href="{{ route('prescriptions.pdf', $prescription->id) }}" 
                                           class="btn btn-sm btn-success" 
                                           title="Download PDF">
                                            <i class="fas fa-file-pdf"></i>
                                            <p>PDF</p>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('prescriptions.destroy', $prescription->id) }}" 
                                              method="POST" 
                                              style="display:inline-block;"
                                              onsubmit="return confirm('Are you sure you want to delete this prescription?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" 
                                                    type="submit" 
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                                <p>Delete</p>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>No prescriptions found</p>
                                    <a href="{{ route('prescriptions.create') }}" class="btn btn-primary">
                                        Create First Prescription
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-group .btn {
        margin: 0 2px;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
</style>
@endsection