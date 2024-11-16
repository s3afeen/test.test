@extends('layouts.app')
@section('content')


<div class="card-body">
    <h4 class="card-title">Product Management</h4>
    <p class="card-description"> Add class <code>.table-bordered</code></p>

    <!-- زر لإضافة منتج جديد -->
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th> # </th>
                <th> Product Name </th>
                <th> Description </th>
                <th> Price </th>
                <th> Category </th>
                <th> Created At </th>
                <th> Image </th>
                <th> Actions </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td> {{ $product->id }} </td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                </td>
                <td> {{ \Illuminate\Support\Str::limit($product->description, 50, '...') }} </td>
                <td> ${{ number_format($product->price, 2) }} </td>
                <td> {{ $product->category->name ?? 'N/A' }} </td> <!-- عرض اسم الفئة أو N/A إن لم توجد -->
                <td> {{ $product->created_at->format('M d, Y') }} </td>
                <td>
                    @if ($product->productImages->isNotEmpty())
                        <img src="{{ asset('storage/' . $product->productImages->first()->image_path) }}" alt="Product Image" width="100">
                    @else
                        No Image
                    @endif
                </td>

                <td>
                    <!-- أزرار الإجراءات -->
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
