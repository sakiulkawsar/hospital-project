@extends('admin.maindesign')
<base href="/public">

@section('main')
<div class="page-section">
    <div class="container">
        <h1 class="text-center wow fadeInUp">Edit Room</h1>

        <form class="contact-form mt-5"
              action="{{ route('room.update', $room->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            {{-- Success --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row mb-3">

                {{-- Room Number --}}
                <div class="col-sm-6 py-2">
                    <label>Room Number</label>
                    <input type="text" name="room_number"
                           value="{{ old('room_number', $room->room_number) }}"
                           class="form-control">
                </div>

                {{-- Room Type --}}
                <div class="col-sm-6 py-2">
                    <label>Room Type</label>
                    <input type="text" name="room_type"
                           value="{{ old('room_type', $room->room_type) }}"
                           class="form-control">
                </div>

                {{-- Department --}}
                <div class="col-12 py-2">
                    <label>Department</label>
                    <input type="text" name="department"
                           value="{{ old('department', $room->department) }}"
                           class="form-control">
                </div>

                {{-- Available --}}
                <div class="col-12 py-2">
                    <label>Available</label>

                    <select name="available" class="form-control">
                        <option value="1"
                            {{ $room->available ? 'selected' : '' }}>
                            Available
                        </option>

                        <option value="0"
                            {{ !$room->available ? 'selected' : '' }}>
                            Not Available
                        </option>
                    </select>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">
                Update Room
            </button>

        </form>
    </div>
</div>
@endsection
