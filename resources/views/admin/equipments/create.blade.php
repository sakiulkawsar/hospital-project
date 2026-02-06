@extends('admin.maindesign')
<base href="/public">
@section('main')
<div class="container">
    <h2>Add Equipment</h2>

    <form action="{{ route('equipment.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Item Name</label>
            <input type="text" name="item_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Quantity in Stock</label>
            <input type="number" name="quantity_in_stock" class="form-control" min="0" required>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Add Equipment</button>
    </form>
</div>
@endsection
