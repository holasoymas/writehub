@extends('admin.layout')

@section('title','Admin - Dashboard')

@section('content')
    <div class="columns is-multiline">
        <div class="column is-one-quarter">
            <div class="box">
                <p class="heading">Total Users</p>
                <p class="title">{{ $totalUsers ?? \App\Models\User::count() }}</p>
            </div>
        </div>

        <div class="column is-one-quarter">
            <div class="box">
                <p class="heading">Total Posts</p>
                <p class="title">{{ $totalPosts ?? \App\Models\Post::count() }}</p>
            </div>
        </div>

        <div class="column is-one-quarter">
            <div class="box">
                <p class="heading">Total Comments</p>
                <p class="title">{{ $totalComments ?? \App\Models\Comment::count() }}</p>
            </div>
        </div>

        <div class="column is-full">
            <div class="box">
                <p class="heading">Recent Posts</p>
                <div>
                    <table class="table is-fullwidth is-striped">
                        <thead>
                            <tr><th>Title</th><th>Author</th><th>Created</th><th></th></tr>
                        </thead>
                        <tbody>
                            @foreach($recentPosts as $p)
                                <tr>
                                    <td>{{ $p->title }}</td>
                                    <td>{{ $p->user->name ?? '—' }}</td>
                                    <td>{{ $p->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="button is-small is-outlined" href="{{ route('admin.posts', $p) }}">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

