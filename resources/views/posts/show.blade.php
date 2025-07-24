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

<script>hljs.highlightAll();
    const comments = @json($post->comments);
</script>
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
                <button class="action-btn" onclick="toggleLike(this)">
                    {{-- <i class="far fa-heart"></i> --}}
{{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M336 16l0 64c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64c0-8.8 7.2-16 16-16s16 7.2 16 16zm-98.7 7.1l32 48c4.9 7.4 2.9 17.3-4.4 22.2s-17.3 2.9-22.2-4.4l-32-48c-4.9-7.4-2.9-17.3 4.4-22.2s17.3-2.9 22.2 4.4zM135 119c9.4-9.4 24.6-9.4 33.9 0L292.7 242.7c10.1 10.1 27.3 2.9 27.3-11.3l0-39.4c0-17.7 14.3-32 32-32s32 14.3 32 32l0 153.6c0 57.1-30 110-78.9 139.4c-64 38.4-145.8 28.3-198.5-24.4L7 361c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l53 53c6.1 6.1 16 6.1 22.1 0s6.1-16 0-22.1L23 265c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l93 93c6.1 6.1 16 6.1 22.1 0s6.1-16 0-22.1L55 185c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l117 117c6.1 6.1 16 6.1 22.1 0s6.1-16 0-22.1l-93-93c-9.4-9.4-9.4-24.6 0-33.9zM433.1 484.9c-24.2 14.5-50.9 22.1-77.7 23.1c48.1-39.6 76.6-99 76.6-162.4l0-98.1c8.2-.1 16-6.4 16-16l0-39.4c0-17.7 14.3-32 32-32s32 14.3 32 32l0 153.6c0 57.1-30 110-78.9 139.4zM424.9 18.7c7.4 4.9 9.3 14.8 4.4 22.2l-32 48c-4.9 7.4-14.8 9.3-22.2 4.4s-9.3-14.8-4.4-22.2l32-48c4.9-7.4 14.8-9.3 22.2-4.4z"/></svg> --}}
<i class="fa-solid fa-hands-clapping"></i>
                    <span>54</span>
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
