@extends('layouts.app')
@section('content')

<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Edit Product</h4>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- حقل اسم المنتج -->
                <div class="form-group mb-3">
                    <label for="productName">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="name" placeholder="Enter product name" value="{{ $product->name }}" required>
                </div>

                <!-- حقل الوصف -->
                <div class="form-group mb-3">
                    <label for="productDescription">Description</label>
                    <textarea class="form-control" id="productDescription" name="description" placeholder="Enter product description" rows="4" required>{{ $product->description }}</textarea>
                </div>

                <!-- حقل السعر -->
                <div class="form-group mb-3">
                    <label for="productPrice">Price</label>
                    <input type="number" class="form-control" id="productPrice" name="price" placeholder="Enter product price" step="0.01" value="{{ $product->price }}" required>
                </div>

                <!-- قائمة اختيار الفئة -->
                <div class="form-group mb-4">
                    <label for="productCategory">Category</label>
                    <select class="form-control" id="productCategory" name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- حقل الصورة -->
                <div class="form-group mb-4">
                    <label for="productImage">Product Image</label>
                    <input type="file" class="form-control-file" id="productImage" name="image_path">
                    <!-- عرض الصورة الحالية إذا كانت موجودة -->
                    @if ($product->productImages->isNotEmpty())
                        <img src="{{ asset('storage/' . $product->productImages->first()->image_path) }}" alt="Product Image" width="100" class="mt-3">
                    @endif
                </div>

                <!-- أزرار التحكم -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="{{ route('products.index') }}" class="btn btn-light">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
