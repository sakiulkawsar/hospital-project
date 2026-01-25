@extends('admin.maindesign')
<base href="/public">
@section('main')

<div class="page-section">
  <div class="container">
    <h1 class="text-center">Edit Specialty</h1>

    <form class="contact-form mt-5"
          action="{{ route('specialties.update', $specialty->id) }}"
          method="POST">
      @csrf
      @method('PUT')

      @if($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="row mb-3">
        <div class="col-12 py-2">
          <label>Specialty Name</label>
          <input type="text"
                 name="name"
                 class="form-control"
                 value="{{ old('name', $specialty->name) }}">
        </div>

        <div class="col-12 py-2">
          <label>Description</label>
          <textarea name="description"
                    class="form-control"
                    rows="4">{{ old('description', $specialty->description) }}</textarea>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">
        Update Specialty
      </button>
    </form>
  </div>
</div>

@endsection