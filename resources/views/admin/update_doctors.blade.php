@extends('admin.maindesign')
<base href="/public">

@section('main')

<div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Get in Touch</h1>

      <form class="contact-form mt-5" action="{{ route('post_update_doctors', $doctor->id) }}" method="post" enctype="multipart/form-data">
        @csrf
          @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        
        <div class="row mb-3">
          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Doctor Name</label>
            <input type="text" id="fullName" name="doctors_name" value="{{ $doctor->doctors_name ?? '' }}" class="form-control" placeholder="Doctor name..">
          </div>
          <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="emailAddress">Doctor Phone number</label>
            <input type="text" id="emailAddress" name="doctors_phone" value="{{ $doctor->doctors_phone ?? '' }}" class="form-control" placeholder="doctors phone..">
          </div>
          <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">Specialty</label>
            <input type="text" id="subject" name="specialty" value="{{ $doctor->specialty ?? '' }}" class="form-control" placeholder="Enter specialty..">
          </div>

             <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">Room Number</label>
            <input type="text" id="subject" name="room_number" value="{{ $doctor->room_number ?? '' }}" class="form-control" placeholder="Enter room_number..">
          </div>

          {{-- Old image --}}
           <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">Old Image</label>
           
            <img src="{{ asset($doctor->doctor_image) }}" 
     alt="{{ $doctor->doctor_image }}" 
     style="width:100px;height:100px;">
          </div>

            <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">New Image</label>
            <input type="file" id="subject" name="doctor_image" class="form-control">
          </div>
         
        </div>
        <button type="submit" class="btn btn-primary wow zoomIn">Add-Doctor</button>
      </form>
    </div>
  </div>
@endsection
