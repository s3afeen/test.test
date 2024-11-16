@extends('layouts.masterUserSide.master')
@section('content')

<div class="container">
    <h2>Account Settings</h2>
    <form action="{{ route('account.settings.update') }}" method="POST">
        @csrf
        <!-- حقل الاسم -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}">
        </div>

        <!-- حقل البريد الإلكتروني -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}">
        </div>

        <!-- حقل كلمة المرور -->
        <div class="form-group">
            <label for="password">Password:</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control">
                <button type="button" id="togglePassword" class="btn btn-darck">
                Show
                </button>
            </div>
        </div>

        <script>
            document.getElementById('togglePassword').addEventListener('click', function () {
                const passwordField = document.getElementById('password');
                const passwordFieldType = passwordField.getAttribute('type');

                if (passwordFieldType === 'password') {
                    passwordField.setAttribute('type', 'text');
                    this.textContent = 'Hide';
                } else {
                    passwordField.setAttribute('type', 'password');
                    this.textContent = 'Show';
                }
            });
        </script>





        <!-- زر التحديث -->
        <button type="submit" class="btn btn-primary">Update</button>
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
    </form>
</div>
@endsection
