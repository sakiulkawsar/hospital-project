@extends('admin.maindesign')
<base href="/public">
@section('main')

<div class="page-section">
  <div class="container">
    <h1 class="text-center wow fadeInUp">Add Specialty</h1>

    <form class="contact-form mt-5"
          action="{{ route('specialties.store') }}"
          method="POST">
      @csrf

      {{-- success --}}
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      {{-- validation errors --}}
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
                 value="{{ old('name') }}"
                 placeholder="e.g. Cardiology">
        </div>

        <div class="col-12 py-2">
          <label>Description</label>
          <textarea name="description"
                    class="form-control"
                    rows="4"
                    placeholder="Optional description...">{{ old('description') }}</textarea>
        </div>
      </div>

      <button type="submit" class="btn btn-primary wow zoomIn">
        Add Specialty
      </button>
    </form>
  </div>
</div>

@endsection