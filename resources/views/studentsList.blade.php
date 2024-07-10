@extends('pages.master_layout')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('addStudentPage') }}" class="btn btn-success mt-5">Add New Student</a>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Age</th>
            <th scope="col">City</th>
            <th scope="col">Delete</th>
            <th scope="col">Update</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>
                        <img src="{{ asset('storage/' . $user->file) }}" alt="Student Image" width="100">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->age }}</td>
                    <td>{{ $user->address }}</td>
                    <td class="text-center">
                        <a href="{{ route('deleteUser', $user->id) }}" class="delete-user">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                    {{-- <td class="text-center">
                        <form action="{{ route('deleteUser', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td> --}}
                    <td class="text-center">
                        <a href="{{ route('UpdateUserPage', $user->id) }}">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteLinks = document.querySelectorAll('.delete-user');

        deleteLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link behavior

                const confirmation = confirm('Are you sure you want to delete this user?');

                if (confirmation) {
                    window.location.href = this.href; // Proceed with the deletion if confirmed
                }
            });
        });
    });
</script>


@endsection
