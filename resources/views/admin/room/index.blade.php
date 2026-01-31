@extends('admin.maindesign')
<base href="/public">

@section('main')
<div class="container mt-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Prescriptions</h1>
            <a href="{{ route('room.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New room
            </a>
        </div>

    <h2>All Rooms</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        
        <thead>
            <tr>
                <th>ID</th>
                <th>Room Number</th>
                <th>Room Type</th>
                <th>Department</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($rooms as $room)
            <tr>
                <td>{{ $room->id }}</td>
                <td>{{ $room->room_number }}</td>
                <td>{{ $room->room_type }}</td>
                <td>{{ $room->department }}</td>

                <td>
                    @if($room->available)
                        <span class="badge bg-success">Available</span>
                    @else
                        <span class="badge bg-danger">Not Available</span>
                    @endif
                </td>

                <td>

                    {{-- Edit --}}
                    <a href="{{ route('room.edit', $room->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    {{-- Delete --}}
                    <form action="{{ route('room.destroy', $room->id) }}"
                          method="POST"
                          style="display:inline-block">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>

                </td>

            </tr>
        @endforeach
        </tbody>

    </table>

</div>
@endsection
