<table class="table table-bordered">
    <thead>
        <tr>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Medicines</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($prescriptions as $prescription)
        <tr>
            <td>{{ $prescription->patient->name }}</td>
            <td>{{ $prescription->doctor->name }}</td>
            <td>{{ $prescription->medicines }}</td>
            <td>{{ $prescription->created_at->format('d M Y') }}</td>
            <td>
                {{-- Edit --}}
                <a href="{{ route('prescriptions.edit', $prescription->id) }}" class="btn btn-sm btn-warning">
                    Edit
                </a>

                {{-- Delete --}}
                <form action="{{ route('prescriptions.destroy', $prescription->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>

                {{-- ✅ Download PDF --}}
              @foreach($prescriptions as $prescription)
    <a href="{{ route('prescriptions.pdf', $prescription->id) }}" class="btn btn-sm btn-success">
        Download PDF
    </a>
@endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
