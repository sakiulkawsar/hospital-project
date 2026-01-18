@extends('admin.maindesign')

@section('view_doctors')
<div style="padding-right: 400px; ">
<table >
    <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Specialty</th>
            <th>Room</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($doctors as $doctor )
            
      
        <tr>
            <td>{{ $doctor->doctors_name }}</td>
            <td>{{ $doctor->doctors_phone }}</td>
            <td>{{ $doctor->specialty }}</td>
            <td>{{ $doctor->room_number }}</td>
            <td><img src="{{ $doctor->doctor_image_url }}" alt="{{ $doctor->doctors_name }}"></td>
        </tr>
          @endforeach
    </tbody>
</table>
</div>
@endsection