@extends('admin.maindesign')

@section('main')
<div class="container-fluid">
     
    <!-- table wrapper for horizontal scroll -->
    <div class="table-responsive">
        <table class="table table-bordered table-sm text-center">
            <thead>
                <tr style="background-color:lightblue;">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Submission Date</th>
                    <th>Specialty</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->full_name }}</td>
                    <td>{{ $appointment->email_address }}</td>
                    <td>{{ $appointment->submission_date }}</td>
                    <td>{{ $appointment->specialty->name ?? '' }}</td>
                    <td>{{ $appointment->number }}</td>
                    <td style="max-width:200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $appointment->message }}
                    </td>
                    <td>{{ $appointment->status }}</td>
                    <td>
                        <form action="{{ route('changestatus', $appointment->id) }}" method="post">
                            @csrf
                            <select name="status" id="status" class="form-select form-select-sm">
                                <option value="In Progress" {{ $appointment->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <input class="btn btn-primary btn-sm mt-1" type="submit" value="Update">
                        </form>
                    </td>
                    

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
