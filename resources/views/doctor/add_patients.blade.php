@extends('doctor.main')
@section('main')
<form action="{{ route('add_patients.store') }}" method="post" enctype="multipart/form-data" style="padding-left: 100px;">
    @csrf
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <label>Fill the from</label>
    <div>
       
        <input type="text" name="patients_name" placeholder="Enter Patients name">

    </div><br><br>

        <div>
        <input type="text" name="patients_phone" placeholder="Enter Patients phone">

    </div><br><br>

        <div>
        <input type="text" name="problem" placeholder="Enter Patients Problem">

    </div><br><br>

        <div>
            <label style="border-radius: 12px; padding: 8px" class="bg bg-primary" for="patients_image">Upload Patients's image</label>
        <input type="file" name="patient_image" >

    </div><br><br>
    <div>
        <input type="submit" name="submit" value="add-patients">
    </div>

</form>
@endsection