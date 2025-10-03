<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Writehub | {{ $post->title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comments.css') }}">
    <link rel="stylesheet" href="{{ asset('css/error-box.css') }}">
    <script type="module" src="{{ asset('js/navbar.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/styles/atom-one-dark.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/highlight.min.js"></script>

<!-- and it's easy to individually load additional languages -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/languages/go.min.js"></script>
@vite(['resources/js/renderPost.js'])
@vite(['resources/js/renderComment.js'])
@vite(['resources/js/likes.js'])
@vite(['resources/js/bookmark.js'])
@vite(['resources/js/dropdown.js'])
@vite(['resources/js/searchInput.js'])

<script>hljs.highlightAll();
const post = @json($post);
console.log(post);
</script>
</head>
<body>
    <x-navbar :user="$post->user" />

    {{-- for displaying errors  --}}
    <x-error-box />

    <div class="medium-container">

        <!-- Post Title -->
        <h1 class="title is-2">{{ $post->title }}</h1>

        <!-- Author Section -->
        <div class="author-section">
            <img src="{{ $post->user->profile_pic }}" alt="profile_pic" class="author-avatar">
            <div class="author-info">
                <h4>{{ $post->user->name }}</h4>
                <div class="author-meta">{{ $post->estimatePostReadTime }} min read · {{$post->readableCreatedAt }}</div>
            </div>
            <div class="column is-narrow follow-btn-div">

                {{-- following/ follow btn --}}
            @auth
                @if ($post->user->isNotSelf())
                    @if (auth()->user()->followings->contains($post->user))
                        <form method="POST" action='{{ route('user.unfollow', ['user' => $post->user ]) }}'>
                            @csrf
                            @method("DELETE")
                            <button class="follow-btn">Following</button>
                        </form>
                    @else
                        <form method="POST" action='{{ route('user.follow', ['user' => $post->user ]) }}'>
                            @csrf
                            <button class="follow-btn">Follow</button>
                        </form>
                    @endif
                @endif
                @else
                <form method="GET" action='{{ route('login') }}'>
                    <button class="follow-btn">Follow</button>
                </form>
            @endauth
            </div>
            </div>

        <!-- Post Actions -->
        <div class="post-actions">
            <div class="action-left">
                <button
                    class="action-btn like {{ $post->is_liked ? 'liked' : '' }}"
                    data-likable-id="{{ $post->id }}"
                    data-likable-type="Post" >
                    <i id="post-like-btn" class="fa-solid fa-hands-clapping"></i>
                    <span>{{ $post->likes_count }}</span>
                </button>
                <button class="action-btn" onclick="scrollToComments()">
                    <i class="far fa-comment"></i>
                    <span>{{ $post->comments_count }}</span>
                </button>
            </div>
            <div class="action-right">
                <button class="action-btn {{ $post->is_bookmarked ? 'active' : ''}}" data-post-id="{{ $post->id }}" data-action="bookmark">
                    <i class="far fa-bookmark"></i>
                </button>
           </div>
        </div>

        <!-- Post Content -->
        {{-- <div id='output'></div> --}}
        <div class="post-content" data-post-id={{ $post->id }} data-content="{{ json_encode($post->content) }}" >
            {{-- Dynamically render the blog --}}
        </div>

        {{-- Dynamically add tags --}}
        <hr />
        <div class="tags">
            @foreach ($post->tags as $tag)
              <span class="tag is-medium">{{ $tag->name }}</span>
            @endforeach
        </div>

        <!-- Comments Section -->
        <div class="comments-section">
            <div class="comments-title">Responses ({{ $post->comments_count }})</div>

            <!-- Comment Form -->
            <div class="comment-form">
                <div style="display: flex; align-items: center; margin-bottom: 16px;">
                    <img src="{{ $post->user->profile_pic }}" alt="Holasoymas" class="comment-avatar" style="margin-right: 12px;">
                    <span style="font-weight: 500; color: #242424;">{{ $post->user->name }}</span>
                </div>
                <textarea id="new-comment" placeholder="What are your thoughts?"></textarea>
                <button id="new-comment-btn">Comment</button>
            </div>

            <div id="comments-container" data-comment="{{ json_encode($post->comments) }}">
            <!-- Comments List -->
            </div>
        </div>
    </div>

    <script>

        // Scroll to comments
        function scrollToComments() {
            document.querySelector('.comments-section').scrollIntoView({
                behavior: 'smooth'
            });
        }

    </script>
</body>
</html>
