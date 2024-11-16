@extends('layouts.app')
@section('content')


<div class="card-body">
    <h4 class="card-title">Category Management</h4>
    <p class="card-description"> Add class <code>.table-bordered</code></p>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th> # </th>
            <th> Category Name </th>
            <th> Description </th>
            <th> Created At </th>
            <th> Image </th>
            <th> Actions </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td> {{ $category->id }} </td>

            <td> {{ $category->name }} </td>
            <td> {{ $category->description }} </td>
            <td> {{ $category->created_at->format('M d, Y') }} </td>
            <td>
                @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 50px; height: 50px;">
                @else
                    No Image
                @endif
            </td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
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


@endsection('content');
