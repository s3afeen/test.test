@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="mt-5">
        <h4>Top Selling Products</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topProducts as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sales }}</td> <!-- هنا يظهر عدد المبيعات لكل منتج -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
