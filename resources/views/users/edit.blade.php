@extends('layouts.app')
@section('content')

<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Edit User</h4>
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- حقل اسم المستخدم -->
                <div class="form-group mb-3">
                    <label for="userName">User Name</label>
                    <input type="text" class="form-control" id="userName" name="name" placeholder="Enter user name" value="{{ $user->name }}" required>
                </div>

                <!-- حقل البريد الإلكتروني -->
                <div class="form-group mb-3">
                    <label for="userEmail">Email</label>
                    <input type="email" class="form-control" id="userEmail" name="email" placeholder="Enter user email" value="{{ $user->email }}" required>
                </div>

                <!-- حقل كلمة المرور -->
                <div class="form-group mb-3">
                    <label for="userPassword">Password</label>
                    <input type="password" class="form-control" id="userPassword" name="password" placeholder="Enter new password (optional)">
                </div>

                <!-- حقل تأكيد كلمة المرور -->
                <div class="form-group mb-3">
                    <label for="passwordConfirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation" placeholder="Confirm new password">
                </div>

                <!-- أزرار التحكم -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update User</button>
                    <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
