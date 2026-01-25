@extends('maindesign')

@section('main')
<div class="page-section">
    <div class="container">
        <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

        {{-- ✅ Success Message --}}
        @if(session('appointment_message'))
            <div class="alert alert-success">
                {{ session('appointment_message') }}
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

        <form class="main-form mt-5" action="{{ route('appointment') }}" method="POST">
            @csrf
            <div class="row mt-5">

                {{-- Full Name --}}
                <div class="col-12 col-sm-6 py-2">
                    <label>Full Name</label>
                    <input type="text"
                           name="full_name"
                           value="{{ old('full_name') }}"
                           class="form-control @error('full_name') is-invalid @enderror"
                           placeholder="Full name">
                    @error('full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email Address --}}
                <div class="col-12 col-sm-6 py-2">
                    <label>Email Address</label>
                    <input type="email"
                           name="email_address"
                           value="{{ old('email_address') }}"
                           class="form-control @error('email_address') is-invalid @enderror"
                           placeholder="Email address">
                          @error('email_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                </div>

                {{-- Submission Date --}}
                <div class="col-12 col-sm-6 py-2">
                    <label>Submission Date</label>
                    <input type="date"
                           name="submission_date"
                           value="{{ old('submission_date') }}"
                           class="form-control @error('submission_date') is-invalid @enderror">
                    @error('submission_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Specialty --}}
                <div class="col-12 col-sm-6 py-2">
                    <label>Specialty</label>
                    <select name="specialty_id"
                            class="custom-select @error('specialty_id') is-invalid @enderror">
                        <option value="">Select Specialty</option>
                        @foreach ($specialties as $specialty)
                            <option value="{{ $specialty->id }}" {{ old('specialty_id') == $specialty->id ? 'selected' : '' }}>
                                {{ $specialty->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('specialty_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Phone Number --}}
                <div class="col-12 py-2">
                    <label>Phone Number</label>
                    <input type="text"
                           name="number"
                           value="{{ old('number') }}"
                           class="form-control @error('number') is-invalid @enderror"
                           placeholder="Phone number">
                    @error('number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Message --}}
                <div class="col-12 py-2">
                    <label>Message</label>
                    <textarea name="message"
                              rows="6"
                              class="form-control @error('message') is-invalid @enderror"
                              placeholder="Enter message">{{ old('message') }}</textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <button type="submit" class="btn btn-primary mt-3 wow zoomIn">
                Submit Appointment
            </button>

        </form>
    </div>
</div>
@endsection
