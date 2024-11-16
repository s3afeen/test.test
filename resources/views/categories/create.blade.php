@extends('layouts.app')
@section('content')

<div class="card-body">
    <h4 class="card-title">Add New Category</h4>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- حقل اسم الفئة -->
        <div class="form-group">
            <label for="categoryName">Category Name</label>
            <input type="text" class="form-control" id="categoryName" name="name" placeholder="Enter category name" required>
        </div>

        <div class="form-group">
            <label for="categoryDescription">Description</label>
            <textarea class="form-control" id="categoryDescription" name="description" placeholder="Enter category description" rows="4" required></textarea>
        </div>



        <div class="form-group">
            <label for="image">Upload Logo for Your Salon</label>
            <input type="file" name="image" id="fileUpload"
                class="form-control @error('image') is-invalid @enderror" required>
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <!-- زر الإرسال وزر الإلغاء -->
        <button type="submit" class="btn btn-primary">Add Category</button>
        <a href="{{ route('categories.index') }}" class="btn btn-light">Cancel</a>


    </form>
</div>

@endsection('content');
