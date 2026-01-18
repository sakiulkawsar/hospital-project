@extends('admin.maindesign')
@section('add_doctors')
<form action="{{ route('add_doctors.store') }}" method="post" enctype="multipart/form-data">
    @csrf
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <label>Fill the from</label>
    <div>
       
        <input type="text" name="doctors_name" placeholder="Enter Doctor name">

    </div><br><br>

        <div>
        <input type="text" name="doctors_phone" placeholder="Enter Doctor phone">

    </div><br><br>

        <div>
        <input type="text" name="specialty" placeholder="Enter Doctor specialty">

    </div><br><br>

        <div>
        <input type="text" name="room_number" placeholder="Enter Doctor room">

    </div><br><br>

        <div>
            <label style="border-radius: 12px; padding: 8px" class="bg bg-primary" for="doctor_image">Upload doctor's image</label>
        <input type="file" name="doctor_image" >

    </div><br><br>
    <div>
        <input type="submit" name="submit" value="add-doctor">
    </div>

</form>
@endsection