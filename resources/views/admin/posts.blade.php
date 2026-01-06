@extends('admin.layout')

@section('title', 'Posts')
@section('page-title', 'Post Management')

@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">All Posts</p>
        </header>

        <div class="card-content p-0">
            <div class="table-container">
                <table class="table is-fullwidth is-hoverable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Published</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>
                                    <strong>{{ $post->title }}</strong>
                                </td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="buttons are-small">
                                        <a href="{{ route('posts.show', $post->slug) }}">
                                        <button class="button is-info">
                                            <span class="icon"><i class="fas fa-eye"></i>
                                            </span>
                                        </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <x-pagination :model="$posts" />

    </div>

@endsection
