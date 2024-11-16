@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Dashboard</h3>
    <div class="row">
        <!-- Total Sales -->
        <div class="col-md-4">
            <div class="card bg-gradient-danger text-white">
                <div class="card-body">
                    <h5>Total Sales</h5>
                    <h2>${{ number_format($totalSales, 2) }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col-md-4">
            <div class="card bg-gradient-info text-white">
                <div class="card-body">
                    <h5>Total Orders</h5>
                    <h2>{{ $orderCount }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-md-4">
            <div class="card bg-gradient-success text-white">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h2>{{ $userCount }}</h2>
                </div>
            </div>
        </div>
    </div>

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
