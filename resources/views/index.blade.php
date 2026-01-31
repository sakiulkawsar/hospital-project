@extends('maindesign')
@section('main')
@include('hero')
  

  <div class="page-section">
    <div class="container">
      <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>

      <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
    @foreach ($doctors as $doctor)
        <div class="item">
            <div class="card-doctor">
                <div class="header">
                    <img src="{{ $doctor->doctor_image_url }}" alt="{{ optional($doctor->user)->name ?? 'No Name' }}">
                    <div class="meta">
                        <a href="#"><span class="mai-call"></span></a>
                        <a href="#"><span class="mai-logo-whatsapp"></span></a>
                    </div>
                </div>
                {{-- <div class="body">
                    <p class="text-xl mb-0">{{ optional($doctor->user)->name ?? 'No Name' }}</p>
                    <span class="text-sm text-grey">{{ $doctor->specialty }}</span>
                </div> --}}
            </div>
        </div>
    @endforeach
</div>

    </div>
  </div>

@endsection