@extends('admin.maindesign')
<base href="/public">
@section('main')
<div class="page-section">
    <div class="container">
        <h1 class="text-center wow fadeInUp">Add Rooms </h1>

        <form class="contact-form mt-5"
              action="{{ route('room.store') }}"
              method="POST">
            @csrf

            {{-- ✅ Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ✅ Validation Errors (ALL) --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row mb-3">

                 <div class="col-sm-6 py-2">
                    <label>Room Number</label>
                    <input type="text"
                           name="room_number"
                           value="{{ old('room_number') }}"
                           class="form-control @error('room_number') is-invalid @enderror"
                           placeholder="room_number..">
                    @error('room_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Room Type --}}
                <div class="col-sm-6 py-2">
                    <label>Room Type</label>
                    <input type="text"
                           name="room_type"
                           value="{{ old('room_type') }}"
                           class="form-control @error('room_type') is-invalid @enderror"
                           placeholder="room_type..">
                    @error('patients_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Department --}}
                <div class="col-12 py-2">
                    <label>Department</label>
                    <input type="text"
                           name="department"
                           value="{{ old('department') }}"
                           class="form-control @error('department') is-invalid @enderror"
                           placeholder="Enter department..">
                    @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 	Avaialble--}}
        <div class="col-12 py-2">
    <label>Available</label>

    <select name="available"
            class="form-control @error('available') is-invalid @enderror">

        <option value="">Select Status</option>
        <option value="1" {{ old('available') == '1' ? 'selected' : '' }}>
            Available
        </option>
        <option value="0" {{ old('available') == '0' ? 'selected' : '' }}>
            Not Available
        </option>

    </select>

            </div>

            <button type="submit" class="btn btn-primary wow zoomIn">
                Add Room
            </button>

        </form>
    </div>
</div>
@endsection
