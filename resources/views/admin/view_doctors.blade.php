@extends('admin.maindesign')

@section('main')

<div class="container-fluid ">
    <div class="row m-0">
        <div class="col-12 p-0">
             <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Prescriptions</h1>
            <a href="{{ route('add_doctors') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add new doctor
            </a>
        </div>

<table class="table table-bordered text-center w-100">
    <thead>
        <tr style="background-color:lightblue;">
            <th>User</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Specialty</th>
            <th>Room</th>
            <th>Image</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($doctors as $doctor)
        <tr>
            <td>{{ $doctor->user->name ?? 'Not assigned' }}</td>
            <td>{{ $doctor->user->email ?? '' }}</td>
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
              <td>
                <a href="{{ route('update_doctor', $doctor->id) }}"
                   
                   style="background:green;color:#fff;padding:6px 12px;text-decoration:none;border-radius:4px;">
                    Update
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
