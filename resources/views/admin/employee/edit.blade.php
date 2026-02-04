@extends('admin.maindesign')
<base href="/public">

@section('main')
<div class="page-section">
    <div class="container">
        <h1 class="text-center wow fadeInUp">Edit Employee</h1>

        <form class="contact-form mt-5"
              action="{{ route('employee.update', $employee->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            {{-- Success --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Validation Errors --}}
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
                    <input type="text" name="name"
                           value="{{ old('name', $employee->name) }}"
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-sm-6 py-2">
                    <label>Phone</label>
                    <input type="text" name="phone"
                           value="{{ old('phone', $employee->phone) }}"
                           class="form-control @error('phone') is-invalid @enderror">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 py-2">
                    <label>Address</label>
                    <input type="text" name="address"
                           value="{{ old('address', $employee->address) }}"
                           class="form-control @error('address') is-invalid @enderror">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 py-2">
                    <label>Gender</label>
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                        <option value="Male" {{ old('gender', $employee->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $employee->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 py-2">
                    <label>Department</label>
                    <input type="text" name="department"
                           value="{{ old('department', $employee->department) }}"
                           class="form-control @error('department') is-invalid @enderror">
                    @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 py-2">
                    <label>Designation</label>
                    <input type="text" name="designation"
                           value="{{ old('designation', $employee->designation) }}"
                           class="form-control @error('designation') is-invalid @enderror">
                    @error('designation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Update Employee</button>
        </form>
    </div>
</div>
@endsection
