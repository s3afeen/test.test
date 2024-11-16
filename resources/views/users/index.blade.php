@extends('layouts.app')
@section('content')

<div class="card-body">
    <h4 class="card-title">Users Management</h4>
    <p class="card-description"> Add class <code>.table-bordered</code></p>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add New User</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th> # </th>
                <th> Id </th>
                <th> User Name </th>
                <th> Email </th>
                <th> password </th>
                <th> Created At </th>
                <th> Actions </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $user->id }} </td>
                <td> {{ $user->name }} </td>
                <td> {{ $user->email }} </td>
                <td> {{ $user->password }} </td>

                <td> {{ $user->created_at->format('M d, Y H:i') }} </td>
                <td>

                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
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

