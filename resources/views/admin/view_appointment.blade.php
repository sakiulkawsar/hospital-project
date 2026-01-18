@extends('admin.maindesign')

@section('view_appointment')

<table class="table table-bordered text-center w-100">
    <thead>
        <tr style="background-color:lightblue;">
            <th>Name</th>
            <th>Email</th>
            <th>Submission Date</th>
            <th>Specialty</th>
            <th>Phone</th>
            <th>Message</th>
            <th>Status</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach ($appointments as $appointment)
        <tr>
            <td>{{ $appointment->full_name }}</td>
            <td>{{ $appointment->email_address }}</td>
           
            <td>{{ $appointment->submission_date }}</td>
             <td>{{ $appointment->specialty }}</td>
            <td>{{ $appointment->number }}</td>
            <td>{{ $appointment->message }}</td>
            <td>{{ $appointment->status }}</td>
            
        </tr>
        @endforeach
    </tbody>
</table>
@endsection