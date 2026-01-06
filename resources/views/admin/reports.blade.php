@extends('admin.layout')

@section('title', 'Reported Posts')
@section('page-title', 'Reported Posts Management')

@section('content')
    <div class="card">
        <script>
            const posts = @json($reportedPosts);
            console.log(posts);
        </script>
        <header class="card-header">
            <p class="card-header-title">Reported Posts</p>
        </header>

        <div class="card-content p-0">
            <div class="table-container">
                <table class="table is-fullwidth is-hoverable is-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post</th>
                            <th>Author</th>
                            <th>Reported By</th>
                            <th>Reasons</th>
                            <th>Total Reports</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($reportedPosts as $postId => $reports)
                            @php
                                $post = $reports->first()->post;

                                $author = $post->user->name;

                                $reportCount = $reports->count();

                                $reporterNames = $reports->pluck('user.name')->implode(',');

                                $reportedByLabel = $reportCount == 1
                                    ? $reports->first()->user->name
                                    : "$reportCount users";

                                $reasons = $reports->groupBy('reason');
                        @endphp

                        <tr class="has-background-danger-light">
                            <td>{{ $postId }}</td>
                            <td>
                                <strong>{{ $post->title }}</strong>
                            </td>

                            <td>{{ $author }}</td>

                            {{-- multiple users --}}
                            <td>
                                <span class="tag is-warning"
                                      title="Reported by: {{ $reporterNames }}">
                                    {{ $reportedByLabel }}
                                </span>
                            </td>

                            <td>
                                @foreach ($reasons as $reason => $items)
                                    @if ($reason === 'other')
                                        @foreach ($items as $report)
                                            <span class="tag is-danger">
                                                Other : {{ $report->other ?? 'other' }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="tag is-danger">{{ $reason }} ({{ $items->count() }})</span>
                                    @endif
                                @endforeach
                            </td>

                            <td><span class="tag">{{ $reportCount }}</span></td>

                            <td>
                                <div class="buttons are-small">
                                    <a href="{{ route('posts.show', $post->slug) }}">
                                    <button class="button is-info"><i class="fas fa-eye"></i></button>
                                    </a>
                                    <form action="{{ route('posts.destroy', $postId) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this post?');"
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
    </div>
@endsection

