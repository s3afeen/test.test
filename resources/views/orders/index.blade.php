@extends('layouts.app')
@section('content')


<div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">All Orders <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">$ 15,0000</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Weekly Orders <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">45,6334</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Today orders <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">95,5741</h2>
                  </div>
                </div>
              </div>
            </div>


<div class="card-body">
    <h4 class="card-title">Order Management</h4>
    <p class="card-description"> Add class <code>.table-bordered</code></p>

    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Add New Order</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th> # </th>
                <th> Id </th>
                <th> User Id </th>
                <th> Total </th>
                <th> Status </th>
                <th> Created At </th>
                <th> Actions </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $order->id }} </td>
                <td> {{ $order->user_id }} </td>
                <td> ${{ number_format($order->total, 2) }} </td>
                <td> {{ $order->status }} </td>
                <td> {{ $order->created_at->format('M d, Y H:i') }} </td>
                <td>

                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline;">
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

