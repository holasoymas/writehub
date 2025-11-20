<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Writehub - Discover Stories</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/show.profile.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/profile.dropdown.css') }}">

        @vite(['resources/js/dropdown.js'])
        @vite(['resources/js/searchInput.js'])

    </head>
    <body>
        <!-- Navigation -->
        <x-navbar :user="Auth::user()" />

            <!-- Hero Section -->
            <section class="hero-section">
                <div class="container">
                    <div class="columns is-vcentered">
                        <div class="column is-7">
                            <h1 class="hero-title">Stay curious.</h1>
                            <p class="hero-subtitle">
                            Discover stories, thinking, and expertise from writers on any topic.
                            </p>
                            <button class="button is-white is-large is-rounded">
                                <strong>Start reading</strong>
                            </button>
                        </div>
                        <div class="column is-5 has-text-centered">
                            <i class="fas fa-book-open" style="font-size: 8rem; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main Content -->
            <div class="container">
                <!-- Trending Section -->
                <section class="trending-section">
                    <div class="trending-title">
                        <i class="fas fa-trending-up trending-icon"></i>
                        TRENDING ON WRITEHUB
                    </div>
                    <div class="columns is-multiline">
                        @foreach ($trendingBlogs as $blog)
                            <div class="column is-4">
                                <div class="trending-item">
                                    <div class="trending-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                                    <div class="trending-content">
                                        <h3><a style="color:black;" href="{{ route('posts.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                                        <div class="trending-meta">
                                            <img src="{{ $blog->user->profile_pic }}"
                                                 alt="Author pic" class="author-avatar">
                                                 <span class="author">
                                                     <a style="color:black;" href="{{ route('user.show', $blog->user->id) }}">
                                                         {{ $blog->user->name }}
                                                     </a>
                                                 </span>
                                                 <span class="date">{{ $blog->created_at->format('M j') }}</span>
                                                 <span>{{ $blog->estimatePostReadTime }} min read</span>
                                                 <i class="fas fa-star" style="margin-left: 0.5rem; color: #ffd700;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Articles Grid -->
                <div class="article-grid container">
                    <!-- Main Articles -->
                    <div class="articles-section">
                        @foreach ($rankingPosts as $item)
                            @php
                                $blocks = $item->content; // already in array if casted in model
        $firstPara = collect($blocks)->firstWhere('type', 'paragraph');
        $firstImage = collect($blocks)->firstWhere('type', 'image');
    @endphp
    <div class="article-card" data-post-id="{{ $item->id }}">
        <header class="card-header">
            <p class="card-header-title">
            <img src="{{ $item->user->profile_pic }}" class="profile-avatar" style="width: 22px; height: 22px;" />
            <a href="{{ route('user.show', $item->user->id)}}" style="margin-left:5px;color:black;">{{ $item->user->name }}</a>
            </p>
            <div class="card-header-icon" aria-label="options">
                <div class="dropdown is-right dropdown-article-action">
                    <div class="dropdown-trigger">
                        <button class="button is-white" aria-haspopup="true" aria-controls="dropdown-options">
                            <span class="icon is-small">⋮</span>
                        </button>
                    </div>
                    <div class="dropdown-menu" id="dropdown-options" role="menu">
                        <div class="dropdown-content">
                            <a class="dropdown-item update">Update Post</a>
                            <a class="dropdown-item del">Delete Post</a>
                            <a class="dropdown-item report">Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="columns">
            <div class="column">
                <div class="article-meta">
                    @foreach ($item->tags as $tag)
                        <span class="tag is-light">{{ $tag->name }}</span>
                    @endforeach
                </div>
                <h2 class="title is-4"><a class="has-text-black" href="{{ route('posts.show', ['slug' => $item->slug]) }}">{{ $item->title }}</a></h2>
                @if ($firstPara)
                    <p class="subtitle is-6 has-text-grey truncate-2-lines">{{ $firstPara["data"]["text"] }}</p>
                @endif
                <div class="article-stats">
                    <span><i style="margin-right:3px;" class="fa-solid fa-hands-clapping"></i>{{ $item->likes_count }}</span>
                    <span><i style="margin-right:3px;" class="fas fa-comment"></i>{{ $item->comments_count }} </span>
                </div>
            </div>
            <div class="column is-narrow">
                @if ($firstImage)
                    <img src="{{ $firstImage['data']['file']['url'] }}"
                         alt="Article image" class="article-image">
                     @endif
            </div>
        </div>
    </div>
    @endforeach
    </div>

                    <!-- Sidebar -->
                    <aside class="sidebar">
                        <!-- Discover Topics -->
                        <div class="sidebar-section">
                            <h3 class="sidebar-title">Discover more of what matters to you</h3>
                            <div>
                                @foreach ($tags as $tag)
                                    <a href="#" class="topic-tag">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                            <div style="margin-top: 1rem;">
                                <a href="#" style="color: #1a8917; font-size: 0.875rem; font-weight: 500;">See more topics</a>
                            </div>
                        </div>

                        <!-- Who to Follow -->
                        <div class="sidebar-section">
                            <h3 class="sidebar-title">Who to follow</h3>
                            @foreach ($recommendedFriends as $item)
                                <div class="follow-suggestion">
                                    <img src="{{ $item->profile_pic }}"
                                         alt="User" class="follow-avatar">
                                    <div class="follow-info">
                                        <div class="follow-name">
                                            <a style="color:black;" href="{{ route('user.show', $item->id) }}">{{ $item->name }}</a>
                                        </div>
                                        <div class="follow-bio">{{ $item->bio }}</div>
                                    </div>
                                    <button class="follow-btn" data-user-id="{{ $item->id }}">Follow</button>
                                </div>
                            @endforeach
                        </div>
                    </aside>
                </div>
            </div>

            <!-- Footer -->
            <x-footer />

                <script>
                    // Mobile navbar toggle
                    document.addEventListener('DOMContentLoaded', () => {
                        const navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

                        if (navbarBurgers.length > 0) {
                            navbarBurgers.forEach(el => {
                                el.addEventListener('click', () => {
                                    const target = el.dataset.target;
                                    const targetElement = document.getElementById(target);

                                    el.classList.toggle('is-active');
                                    targetElement.classList.toggle('is-active');
                                });
                            });
                        }
                    });
                </script>
    </body>
</html>
