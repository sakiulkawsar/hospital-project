@extends('admin.maindesign')
<base href="/public">
@section('main')
<div class="container">
    <h2>Equipment List</h2>

    <a href="{{ route('equipment.create') }}" class="btn btn-primary mb-3">Add Equipment</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Quantity in Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($equipments as $equipment)
            <tr>
                <td>{{ $equipment->id }}</td>
                <td>{{ $equipment->item_name }}</td>
                <td>{{ $equipment->category }}</td>
                <td>{{ $equipment->quantity_in_stock }}</td>
                <td>
                    @if($equipment->image)
                        <img src="{{ asset('uploads/equipments/'.$equipment->image) }}" width="80">
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <a href="{{ route('equipment.edit',$equipment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('equipment.destroy',$equipment->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
