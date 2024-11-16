@extends('layouts.app')
@section('content')

<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Edit Category</h4>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- حقل اسم الفئة -->
                <div class="form-group mb-3">
                    <label for="categoryName">Category Name</label>
                    <input type="text" class="form-control" id="categoryName" name="name" placeholder="Enter category name" value="{{ $category->name }}" required>
                </div>

                <!-- حقل الوصف -->
                <div class="form-group mb-3">
                    <label for="categoryDescription">Description</label>
                    <textarea class="form-control" id="categoryDescription" name="description" placeholder="Enter category description" rows="4" required>{{ $category->description }}</textarea>
                </div>


                <div class="form-group">
                    <label for="image">Category Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>

                <!-- أزرار التحكم -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update Category</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-light">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection('content');
