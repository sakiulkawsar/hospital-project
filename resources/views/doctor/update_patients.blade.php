@extends('doctor.main')
<base href="/public">

@section('main')

  <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Get in Touch</h1>

      <form class="contact-form mt-5" action="{{ route('post_update_patients', $patient->id) }}" method="post" enctype="multipart/form-data">
        @csrf
          @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        
        <div class="row mb-3">
          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Patient Name</label>
            <input type="text" id="fullName" name="patients_name" value="{{ $patient->patients_name ?? '' }}" class="form-control" placeholder="Patient name..">
          </div>
          <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="emailAddress">Patient Phone number</label>
            <input type="text" id="emailAddress" name="patients_phone" value="{{ $patient->patients_phone ?? '' }}" class="form-control" placeholder="Patient phone..">
          </div>
          <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">Problem</label>
            <input type="text" id="subject" name="problem" value="{{ $patient->problem ?? '' }}" class="form-control" placeholder="Enter problem..">
          </div>
            {{-- old image --}}
            <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">Old Image</label>
           <img src="{{ asset($patient->patient_image) }}"
     alt="Old Image"
     style="width:100px;height:100px;">
          </div>

            <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">Upload Patient's Image</label>
            <input type="file" id="subject" name="patient_image" class="form-control">
          </div>
         
        </div>
        <button type="submit" class="btn btn-primary wow zoomIn">Add-Patient</button>
      </form>
    </div>
  </div>
@endsection
