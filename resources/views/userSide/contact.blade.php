@extends('layouts.app')

@section('content')
<div class="card-body">
    <h4 class="card-title">Contact Management</h4>
    <p class="card-description">View all messages from users</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th> # </th>
                <th> Name </th>
                <th> Email </th>
                <th> Message </th>
                <th> Created At </th>
                <th> Actions </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td> {{ $contact->id }} </td>
                <td> {{ $contact->name }} </td>
                <td> {{ $contact->email }} </td>
                <td> {{ $contact->message }} </td>
                <td> {{ $contact->created_at->format('M d, Y') }} </td>
                <td>
                    <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info btn-sm">View</a>
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display: inline;">
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
@endsection
