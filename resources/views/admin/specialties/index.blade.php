@extends('admin.maindesign')
<base href="/public">
@section('main')

<div class="container mt-5">
  <h2 class="text-center mb-4">Specialties</h2>

  <a href="{{ route('specialties.create') }}"
     class="btn btn-success mb-3">
    + Add Specialty
  </a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
      @foreach($specialties as $specialty)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $specialty->name }}</td>
          <td>{{ $specialty->description }}</td>
          <td>
            <a href="{{ route('specialties.edit', $specialty->id) }}"
               class="btn btn-sm btn-warning">
              Edit
            </a>

            <form action="{{ route('specialties.destroy', $specialty->id) }}"
                  method="POST"
                  style="display:inline;">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger"
                      onclick="return confirm('Delete this specialty?')">
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