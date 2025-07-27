<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reading Images In Laravel Using Image Intervention 3 - Medium</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/show.post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comments.css') }}">
    <script type="module" src="{{ asset('js/navbar.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/styles/atom-one-dark.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/highlight.min.js"></script>

<!-- and it's easy to individually load additional languages -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/languages/go.min.js"></script>
@vite(['resources/js/renderPost.js'])
@vite(['resources/js/renderComment.js'])
@vite(['resources/js/likes.js'])

<script>hljs.highlightAll();</script>
</head>
<body>
    <x-navbar />
    <div class="medium-container">

        <!-- Post Title -->
        <h1 class="title is-2">{{ $post->title }}</h1>

        <!-- Author Section -->
        <div class="author-section">
            <img src="https://placehold.co/300" alt="Olujimi Sanwo" class="author-avatar">
            <div class="author-info">
                <h4>{{ $post->user->name }}</h4>
                <div class="author-meta">3 min read · Aug 17, 2024</div>
            </div>
            <button class="follow-btn" onclick="toggleFollow(this)">Follow</button>
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
                    <span>3</span>
                </button>
            </div>
            <div class="action-right">
                <button class="action-btn" onclick="toggleBookmark(this)">
                    <i class="far fa-bookmark"></i>
                </button>
                <button class="action-btn" onclick="sharePost()">
                    <i class="fas fa-share"></i>
                </button>
                <button class="action-btn">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
            </div>
        </div>

        <!-- Post Content -->
        {{-- <div id='output'></div> --}}
        <div class="post-content" data-post-id={{ $post->id }} data-content="{{ json_encode($post->content) }}" >
            {{-- Dynamically render the blog --}}
        </div>

        <!-- Author Card -->
        <div class="author-card">
            <div class="author-card-header">
                <img src="https://placehold.co/300" alt="Olujimi Sanwo" class="author-card-avatar">
                <div class="author-card-info">
                    <h4>Written by {{ $post->user->name }}</h4>
                    <div class="author-card-meta">192 followers · 237 following</div>
                </div>
                <button class="follow-btn" onclick="toggleFollow(this)">Follow</button>
            </div>
            <div class="author-card-bio">
                {{ $post->user->bio }}
            </div>
        </div>

        <!-- Comments Section -->
        <div class="comments-section">
            <div class="comments-title">Responses (2)</div>

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

            <div class="comment-item">
                <img src="https://placehold.co/400" alt="Sarah Martinez" class="comment-avatar">
                <div class="comment-content">
                    <div class="comment-header">
                        <span class="comment-author">Sarah Martinez</span>
                        <span class="comment-time">6 hours ago</span>
                    </div>
                    <div class="comment-text">
                        Perfect timing! I'm working on a photo gallery feature and this tutorial covers everything I need. The code examples are clear and easy to follow.
                    </div>
                    <div class="comment-actions">
                        <button class="comment-action" onclick="toggleCommentLike(this)">
                            <i class="far fa-heart"></i>
                            <span>15</span>
                        </button>
                        <button class="comment-action">
                            <i class="fas fa-reply"></i>
                            Reply
                        </button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle follow button
        function toggleFollow(btn) {
            if (btn.textContent === 'Follow') {
                btn.textContent = 'Following';
                btn.style.background = '#1a8917';
                btn.style.color = 'white';
            } else {
                btn.textContent = 'Follow';
                btn.style.background = 'none';
                btn.style.color = '#1a8917';
            }
        }

        // Toggle like button
        function toggleLike(btn) {
            const icon = btn.querySelector('i');
            const count = btn.querySelector('span');
            const currentCount = parseInt(count.textContent);

            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                icon.style.color = '#ff3040';
                count.textContent = currentCount + 1;
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                icon.style.color = '#6b6b6b';
                count.textContent = currentCount - 1;
            }
        }

        // Toggle bookmark
        function toggleBookmark(btn) {
            const icon = btn.querySelector('i');

            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                icon.style.color = '#1a8917';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                icon.style.color = '#6b6b6b';
            }
        }

        // Toggle comment like
        function toggleCommentLike(btn) {
            const icon = btn.querySelector('i');
            const count = btn.querySelector('span');
            const currentCount = parseInt(count.textContent);

            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                icon.style.color = '#ff3040';
                count.textContent = currentCount + 1;
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                icon.style.color = '#6b6b6b';
                count.textContent = currentCount - 1;
            }
        }

        // Scroll to comments
        function scrollToComments() {
            document.querySelector('.comments-section').scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Share post
        function sharePost() {
            if (navigator.share) {
                navigator.share({
                    title: 'Reading Images In Laravel Using Image Intervention 3',
                    text: 'Check out this article about Laravel image processing',
                    url: window.location.href
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                navigator.clipboard.writeText(window.location.href);
                alert('Link copied to clipboard!');
            }
        }
    </script>
</body>
</html>
