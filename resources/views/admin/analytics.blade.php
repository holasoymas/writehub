@extends('admin.layout')
@section('title', 'Analytics')
@section('page-title', 'Analytics Dashboard')

@section('content')

{{-- STAT CARDS --}}
<div class="columns is-multiline">
    <div class="column is-3-desktop is-6-tablet">
        <div class="card">
            <div class="card-content">
                <p class="heading">Total Users</p>
                <p class="title has-text-info">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>
    <div class="column is-3-desktop is-6-tablet">
        <div class="card">
            <div class="card-content">
                <p class="heading">Total Posts</p>
                <p class="title has-text-success">{{ $totalPosts }}</p>
            </div>
        </div>
    </div>
    <div class="column is-3-desktop is-6-tablet">
        <div class="card">
            <div class="card-content">
                <p class="heading">Total Comments</p>
                <p class="title has-text-warning">{{ $totalComments }}</p>
            </div>
        </div>
    </div>
    <div class="column is-3-desktop is-6-tablet">
        <div class="card">
            <div class="card-content">
                <p class="heading">Reported Posts</p>
                <p class="title has-text-danger">{{ $reportedPosts }}</p>
            </div>
        </div>
    </div>
</div>

{{-- POSTS PER MONTH BAR CHART --}}
<div class="columns">
    <div class="column is-8">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">Posts Per Month (Last 6 Months)</p>
            </header>
            <div class="card-content">
                @foreach($postsPerMonth as $month => $count)
                <div class="mb-3">
                    <div class="is-flex is-justify-content-space-between mb-1">
                        <span>{{ $month }}</span>
                        <strong>{{ $count }}</strong>
                    </div>
                    <progress class="progress is-info"
                        value="{{ $count }}"
                        max="{{ $postsPerMonth->max() }}">
                        {{ $count }}
                    </progress>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- TOP AUTHORS --}}
    <div class="column is-4">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">Top Authors</p>
            </header>
            <div class="card-content">
                @foreach($topAuthors as $index => $author)
                <div class="is-flex is-justify-content-space-between is-align-items-center mb-3">
                    <div>
                        <strong>
                            <a href="{{ route('user.show', $author->id) }}">
                                {{ $author->name ?? 'N/A' }}
                            </a>
                        </strong>
                        <br>
                        <small class="has-text-grey">{{ $author->posts_count }} posts</small>
                    </div>
                    <span class="tag {{ $index === 0 ? 'is-warning' : 'is-light' }}">
                        #{{ $index + 1 }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="card">
    <header class="card-header">
        <p class="card-header-title">Recent Posts</p>
    </header>
    <div class="card-content">
        <table class="table is-fullwidth is-striped is-hoverable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentPosts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>
                        <a href="{{ route('user.show', $post->user->id) }}">
                            {{ $post->user->name ?? 'N/A' }}
                        </a>
                    </td>
                    <td>{{ $post->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->slug) }}" class="button is-small is-info is-light">
                            <span class="icon"><i class="fas fa-eye"></i></span>
                            <span>View</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
