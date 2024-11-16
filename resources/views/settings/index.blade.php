@extends('layouts.app')

@section('content')
<div class="container">
    <h1>General Settings</h1>

    <!-- عرض رسالة النجاح أو الخطأ إن وجدت -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        @method('POST')

        <!-- حقل اسم الموقع -->
        <div class="form-group">
            <label for="site_name">Site Name</label>
            <input type="text" name="site_name" id="site_name" class="form-control" value="{{ $settings['site_name'] ?? '' }}" required>
        </div>

        <!-- حقل البريد الإلكتروني -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $settings['email'] ?? '' }}" required>
        </div>

        <!-- روابط التواصل الاجتماعي -->
        <div class="form-group">
            <label for="facebook">Facebook</label>
            <input type="url" name="facebook" id="facebook" class="form-control" value="{{ $settings['facebook'] ?? '' }}">
        </div>

        <div class="form-group">
            <label for="twitter">Twitter</label>
            <input type="url" name="twitter" id="twitter" class="form-control" value="{{ $settings['twitter'] ?? '' }}">
        </div>

        <!-- زر الحفظ -->
        <button type="submit" class="btn btn-primary">Save Settings</button>

    </form>
</div>
@endsection
