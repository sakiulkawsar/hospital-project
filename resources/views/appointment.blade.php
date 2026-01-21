@extends('maindesign')

@section('all_doctors')

<div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

      <p class="bg bg-primary">
        @if(session('appointment_message'))
        {{ session('appointment_message') }}
      </p>
      @endif

     <form class="main-form" action="{{ route('appointment') }}" method="POST">
    @csrf

    <div class="row mt-5">
        <div class="col-12 col-sm-6 py-2">
            <input type="text" name="full_name" class="form-control" placeholder="Full name">
        </div>

        <div class="col-12 col-sm-6 py-2">
            <input type="email" name="email_address" class="form-control" placeholder="Email address">
        </div>

        <div class="col-12 col-sm-6 py-2">
            <input type="date" name="submission_date" class="form-control">
        </div>
{{-- 
        <div class="col-12 col-sm-6 py-2">
            <select name="specialty" class="custom-select">
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->specialty }}">
                        {{ $doctor->doctors_name }} — {{ $doctor->specialty }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <div class="col-12 py-2">
            <input type="text" name="number" class="form-control" placeholder="Number">
        </div>

        <div class="col-12 py-2">
            <textarea name="message" class="form-control" rows="6" placeholder="Enter message"></textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Submit Request</button>
</form>

    </div>
  </div> <!-- .page-section -->

  <div class="page-section banner-home bg-image" style="background-image: url(front_end/assets/img/banner-pattern.svg);">
    <div class="container py-5 py-lg-0">
      <div class="row align-items-center">
        <div class="col-lg-4 wow zoomIn">
          <div class="img-banner d-none d-lg-block">
            <img src="front_end/assets/img/mobile_app.png" alt="">
          </div>
        </div>
        <div class="col-lg-8 wow fadeInRight">
          <h1 class="font-weight-normal mb-3">Get easy access of all features using One Health Application</h1>
          <a href="#"><img src="front_end/assets/img/google_play.svg" alt=""></a>
          <a href="#" class="ml-2"><img src="front_end/assets/img/app_store.svg" alt=""></a>
        </div>
      </div>
    </div>
  </div> <!-- .banner-home -->
    
@endsection