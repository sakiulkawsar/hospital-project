@extends('admin.maindesign')
<base href="/public">

@section('main')
<div class="page-section">
    <div class="container">
        <h1 class="text-center wow fadeInUp">Add Employee</h1>

        <form class="contact-form mt-5" action="{{ route('employee.store') }}" method="POST">
            @csrf

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-sm-6 py-2">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                </div>

                <div class="col-sm-6 py-2">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                </div>

                <div class="col-12 py-2">
                    <label>Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                </div>

                <div class="col-12 py-2">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">-- Select Gender --</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="col-12 py-2">
                    <label>Department</label>
                    <input type="text" name="department" value="{{ old('department') }}" class="form-control">
                </div>

                <div class="col-12 py-2">
                    <label>Designation</label>
                    <input type="text" name="designation" value="{{ old('designation') }}" class="form-control">
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Add Employee</button>
        </form>
    </div>
</div>
@endsection
