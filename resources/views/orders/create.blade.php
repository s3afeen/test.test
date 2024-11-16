@extends('layouts.app')
@section('content')

<div class="card-body">
    <h4 class="card-title">Add New Order</h4>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <!-- حقل معرف المستخدم -->
        <div class="form-group">
            <label for="user_id">User</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- حقل المجموع الإجمالي -->
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" class="form-control" id="total" name="total" placeholder="Enter total amount" step="0.01" required>
        </div>

        <!-- حقل الحالة -->
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" id="status" name="status" placeholder="Enter order status" required>
        </div>

        <!-- زر الإرسال وزر الإلغاء -->
        <button type="submit" class="btn btn-primary">Add Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>

@endsection
