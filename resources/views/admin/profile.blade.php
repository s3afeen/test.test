@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Admin Profile</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $admin->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $admin->email }}</td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <td>{{ $admin->id }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $admin->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $admin->updated_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
