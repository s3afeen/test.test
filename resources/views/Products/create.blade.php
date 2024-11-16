@extends('layouts.app')
@section('content')

<div class="card-body">
    <h4 class="card-title">Add New Product</h4>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" placeholder="Enter product description" required></textarea>
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" name="price" class="form-control" placeholder="Enter product price" required>
    </div>

    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="image">Product Image</label>
        <input type="file" name="image_path" class="form-control-file" required>
    </div>

    <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

@endsection
