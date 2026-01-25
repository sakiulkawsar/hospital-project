@extends('admin.maindesign')
<base href="/public">
@section('main')

<div class="container mt-5">
  <h2>{{ $specialty->name }}</h2>

  <p>
    <strong>Description:</strong><br>
    {{ $specialty->description ?? 'N/A' }}
  </p>
</div>

@endsection