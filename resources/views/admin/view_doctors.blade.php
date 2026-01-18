@extends('admin.maindesign')

@section('view_doctors')

<div class="container-fluid p-0 m-0">
    <div class="row m-0">
        <div class="col-12 p-0">

<table class="table table-bordered text-center w-100">
    <thead>
        <tr style="background-color:lightblue;">
            <th>Name</th>
            <th>Phone</th>
            <th>Specialty</th>
            <th>Room</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($doctors as $doctor)
        <tr>
            <td>{{ $doctor->doctors_name }}</td>
            <td>{{ $doctor->doctors_phone }}</td>
            <td>{{ $doctor->specialty }}</td>
            <td>{{ $doctor->room_number }}</td>
            <td>
                <img src="{{ $doctor->doctor_image_url }}"
                     style="width:100px;height:100px;">
            </td>
            <td>
                <a href="{{ route('delete_doctor', $doctor->id) }}"
                   onclick="return confirm('Are you sure?')"
                   style="background:#dc3545;color:#fff;padding:6px 12px;text-decoration:none;border-radius:4px;">
                    Delete
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

        </div>
    </div>
</div>

@endsection
