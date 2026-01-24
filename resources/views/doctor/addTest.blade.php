@extends('doctor.main')
@section('main')
  <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Get in Touch</h1>

      <form class="contact-form mt-5"
      action="{{ route('addTest.store') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
          @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        
        <div class="row mb-3">
          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Patient Name</label>
            <input type="text" id="fullName" name="patients_name" class="form-control" placeholder="Patient name..">
          </div>
          <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="emailAddress">Patient Phone number</label>
            <input type="text" id="emailAddress" name="patients_phone" class="form-control" placeholder="Patient phone..">
          </div>
          <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">Problem</label>
            <input type="text" id="subject" name="problem" class="form-control" placeholder="Enter problem..">
          </div>

            <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">Test Name</label>
            <input type="text" id="subject" name="test_name" class="form-control" placeholder="Enter problem..">
          </div>

           <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">Total Amount</label>
            <input type="text" id="subject" name="amount" class="form-control" placeholder="Enter clinical test amount..">
          </div>
         
        </div>
        <button type="submit" class="btn btn-primary wow zoomIn">Add-Patient</button>
      </form>
      
    </div>
  </div>

@endsection