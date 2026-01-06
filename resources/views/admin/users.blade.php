@extends('admin.layout')

@section('title', 'Users')
@section('page-title', 'User Management')

@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">All Users</p>
        </header>

        <div class="card-content p-0">
            <div class="table-container">
                <table class="table is-fullwidth is-hoverable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Posts</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div class="is-flex is-align-items-center">
                                        <figure class="image is-32x32 mr-2">
                                            <img class="is-rounded" src="{{ $user->profile_pic }}" alt="profile_pic">
                                        </figure>
                                        <strong>{{ $user->name }}</strong>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td><span class="tag is-info">{{ $user->posts->count() }}</span></td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="buttons are-small">
                                        <a href="{{ route('user.show', $user->id) }}">
                                            <button class="button is-info"><i class="fas fa-eye"></i></button>
                                        </a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this user ?');"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button is-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <x-pagination :model="$users" />

    </div>

@endsection
