@extends('doctor.main')
<base href="/public">
@section('main')
<div class="container mt-4">
    <h2>All Medical Tests</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Phone</th>
                <th>Test</th>
                <th>Problem</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($medicalTests as $test)
            <tr>
                <td>{{ $test->patients_name }}</td>
                <td>{{ $test->patients_phone}}</td>
                <td>{{ $test->test_name }}</td>
                <td>{{ $test->problem }}</td>
                <td>{{ $test->amount }}</td>
                <td>
                    {{-- EDIT --}}
                    <a href="{{ route('medical_tests.edit', $test->id) }}"
                       class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    {{-- DELETE --}}
                  <form action="{{ route('medical_tests.destroy', $test->id) }}"
      method="POST" style="display:inline-block">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger"
            onclick="return confirm('Are you sure?')">
        Delete
    </button>
</form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
