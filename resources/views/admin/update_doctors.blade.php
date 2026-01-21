@extends('admin.maindesign')
<base href="/public">

@section('main')
<form action="{{ route('post_update_doctors', $doctor->id) }}" method="post" enctype="multipart/form-data" style="padding-left: 100px;">
    @csrf

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <label>Fill the form</label>

    <!-- Doctor Name -->
    <div>
        <input type="text" name="doctors_name" value="{{ $doctor->doctors_name ?? '' }}" placeholder="Doctor Name">
    </div><br><br>

    <!-- Doctor Phone -->
    <div>
        <input type="text" name="doctors_phone" value="{{ $doctor->doctors_phone ?? '' }}" placeholder="Phone Number">
    </div><br><br>

    <!-- Specialty -->
    <div>
        <input type="text" name="specialty" value="{{ $doctor->specialty ?? '' }}" placeholder="Specialty">
    </div><br><br>

    <!-- Room Number -->
    <div>
        <input type="text" name="room_number" value="{{ $doctor->room_number ?? '' }}" placeholder="Room Number">
    </div><br><br>

    <!-- Old Image -->
    <div>
        <label style="border-radius: 12px; padding: 8px" class="bg bg-primary" for="doctor_image">Old Image</label>
       <img src="{{ asset('storage/doctor_images/'.$doctor->doctor_image) }}" 
     alt="{{ $doctor->doctor_image }}" 
     style="width:100px;height:100px;">
    </div><br><br>

    <!-- Upload New Image -->
    <div>
        <label style="border-radius: 12px; padding: 8px" class="bg bg-primary" for="doctor_image">Upload Doctor's Image</label>
        <input type="file" name="doctor_image">
    </div><br><br>

    <!-- Submit Button -->
    <div>
        <input type="submit" name="submit" value="Add Doctor" class="btn btn-success">
    </div>
</form>
@endsection
