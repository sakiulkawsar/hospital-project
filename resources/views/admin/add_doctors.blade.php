@extends('admin.maindesign')
@section('main')


<div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Get in Touch</h1>

      <form class="contact-form mt-5" action="{{ route('add_doctors.store') }}" method="post" enctype="multipart/form-data">
        @csrf
          @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        
        <div class="row mb-3">
          <div class="col-12 py-2 wow fadeInUp">
              <label for="user">Assign User</label>
              <select name="user_id" class="form-select">
                  <option value="">Select User</option>
                  @foreach($users as $user)
                      <option value="{{ $user->id }}">
                          {{ $user->name }} ({{ $user->email }})
                      </option>
                  @endforeach
              </select>
          </div>
          <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="emailAddress">Doctor Phone number</label>
            <input type="text" id="emailAddress" name="doctors_phone" class="form-control" placeholder="doctors phone..">
          </div>
          <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">Specialty</label>
            <input type="text" id="subject" name="specialty" class="form-control" placeholder="Enter specialty..">
          </div>

             <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">Room Number</label>
            <input type="text" id="subject" name="room_number" class="form-control" placeholder="Enter room_number..">
          </div>

            <div class="col-12 py-2 wow fadeInUp">
            <label for="subject">Image</label>
            <input type="file" id="subject" name="doctor_image" class="form-control">
          </div>
         
        </div>
        <button type="submit" class="btn btn-primary wow zoomIn">Add-Doctor</button>
      </form>
    </div>
  </div>
@endsection