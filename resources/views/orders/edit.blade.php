@extends('layouts.app')
@section('content')

<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Edit Order</h4>
            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="userId">User ID</label>
                    <input type="number" class="form-control" id="userId" name="user_id" placeholder="Enter user ID" value="{{ $order->user_id }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="orderTotal">Total</label>
                    <input type="number" class="form-control" id="orderTotal" name="total" placeholder="Enter total amount" step="0.01" value="{{ $order->total }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="orderStatus">Status</label>
                    <input type="text" class="form-control" id="orderStatus" name="status" placeholder="Enter order status" value="{{ $order->status }}" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update Order</button>
                    <a href="{{ route('orders.index') }}" class="btn btn-light">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
