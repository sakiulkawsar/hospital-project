@extends('doctor.main')
<base href="/public">

@section('main')
<form action="{{ route('post_update_patients', $patient->id) }}" method="post" enctype="multipart/form-data" style="padding-left: 100px;">
    @csrf

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <label>Fill the form</label>

    <!-- Doctor Name -->
    <div>
        <input type="text" name="patients_name" value="{{ $patient->patients_name ?? '' }}" placeholder="Doctor Name">
    </div><br><br>

    <!-- Doctor Phone -->
    <div>
        <input type="text" name="patients_phone" value="{{ $patient->patients_phone ?? '' }}" placeholder="Phone Number">
    </div><br><br>

    <!-- Specialty -->
    <div>
        <input type="text" name="problem" value="{{ $patient->problem ?? '' }}" placeholder="Specialty">
    </div><br><br>

   

    <!-- Old Image -->
    <div>
        <label style="border-radius: 12px; padding: 8px" class="bg bg-primary" for="doctor_image">Old Image</label>
       <img src="{{ asset('storage/patient_images/'.$patient->patient_image) }}" 
     alt="{{ $patient->patient_image }}" 
     style="width:100px;height:100px;">
    </div><br><br>

    <!-- Upload New Image -->
    <div>
        <label style="border-radius: 12px; padding: 8px" class="bg bg-primary" for="patient_image">Upload Patient's Image</label>
        <input type="file" name="patient_image">
    </div><br><br>

    <!-- Submit Button -->
    <div>
        <input type="submit" name="submit" value="Add Patient" class="btn btn-success">
    </div>
</form>
@endsection
