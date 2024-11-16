@extends('layouts.app')

@section('content')
<div class="card-body">
    <h4 class="card-title">Contact Us</h4>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->user->name }}</td>
                    <td>{{ $contact->user->email }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>{{ $contact->created_at->format('M d, Y') }}</td>
                    <td>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message? This action cannot be undone.')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination (Optional, if you decide to paginate) --}}
    {{-- {{ $contacts->links() }} --}}
</div>
@endsection
