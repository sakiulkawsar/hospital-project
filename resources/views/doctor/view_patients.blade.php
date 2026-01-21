@extends('admin.maindesign')

@section('main')

<div class="container-fluid ">
    <div class="row m-0">
        <div class="col-12 p-0">

<table class="table table-bordered text-center w-100">
    <thead>
        <tr style="background-color:lightblue;">
            <th>Name</th>
            <th>Phone</th>
            <th>Problem</th>
           
            <th>Image</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
        <tr>
            <td>{{ $patient->patients_name }}</td>
            <td>{{ $patient->patients_phone }}</td>
            <td>{{ $patient->problem }}</td>
           
            <td>
                <img src="{{ $patient->patient_image_url }}"
                     style="width:100px;height:100px;">
            </td>
            <td>
                <a href="{{ route('delete_patient', $patient->id) }}"
                   onclick="return confirm('Are you sure?')"
                   style="background:#dc3545;color:#fff;padding:6px 12px;text-decoration:none;border-radius:4px;">
                    Delete
                </a>
            </td>
              <td>
                <a href="{{ route('update_patient', $patient->id) }}"
                   
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
