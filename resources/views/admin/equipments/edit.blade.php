@extends('admin.maindesign')
<base href="/public">
@section('main')
<div class="container">
    <h2>Edit Equipment</h2>

    <form action="{{ route('equipment.update', $equipment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Item Name</label>
            <input type="text" name="item_name" class="form-control" value="{{ $equipment->item_name }}" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control" value="{{ $equipment->category }}" required>
        </div>

        <div class="mb-3">
            <label>Quantity in Stock</label>
            <input type="number" name="quantity_in_stock" class="form-control" value="{{ $equipment->quantity_in_stock }}" min="0" required>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if($equipment->image)
                <img src="{{ asset('uploads/equipments/'.$equipment->image) }}" width="80" class="mt-2">
            @endif
        </div>

        <button class="btn btn-success">Update Equipment</button>
    </form>
</div>
@endsection
