<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adarsh Gupta - Medium</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/show.profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script type="module" src="{{ asset('js/show.profile.js') }}"></script>

</head>
<body>
    <!-- Navigation / navbar -->
    <x-navbar />

    <div class="container">
        <div class="columns is-desktop">
            <!-- Main Content -->
            <div class="column is-8">
                <!-- Profile Header -->
                <div class="profile-header">
                    <div class="columns is-vcentered">
                        <div class="column is-narrow">
                            <img src=" {{ $user->profile_pic }}"
                                 alt="Adarsh Gupta" class="profile-avatar">
                        </div>
                        <div class="column">
                            <h1 class="title is-2">{{ $user->name }}</h1>
                            <div class="profile-stats">
                                <span id="show-followers" style="margin-right: 1rem;">{{ $user->followers_count }} followers</span>
                                <span id="show-followings">{{ $user->followings_count }} following</span>
                            </div>
                            <p class="profile-bio">
                            {{ $user->bio }}
                            </p>
                            <div class="profile-links">
                                {{-- <a href="#">adarshguptaworks@gmail.com</a> Connect with me? --}}
                                {{-- <a href="#">twitter.com/adarsh____gupta/</a> --}}
                            </div>
                        </div>
                        @auth

                            @if ($user->isNotSelf())
                                @if (auth()->user()->followings->contains($user))
                                    <div class="column is-narrow">
                                      <form method="POST" action='{{ route('user.unfollow', ['user' => $user ]) }}'>
                                          @csrf
                                          @method("DELETE")
                                        <button class="button is-dark is-rounded">Following</button>
                                      </form>
                                    </div>
                                @else
                                    <div class="column is-narrow">
                                      <form method="POST" action='{{ route('user.follow', ['user' => $user ]) }}'>
                                          @csrf
                                        <button class="button is-dark is-rounded">Follow</button>
                                      </form>
                                    </div>
                                @endif
                            @endif
                            @else
                                    <div class="column is-narrow">
                                      <form method="GET" action='{{ route('login') }}'>
                                        <button class="button is-dark is-rounded">Follow</button>
                                      </form>
                                    </div>
                        @endauth
                        </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="tabs">
                    <ul>
                        <li class="is-active" data-tab="home"><a onclick="switchTab('home')">Home</a></li>
                        <li data-tab="lists"><a onclick="switchTab('lists')">Lists</a></li>
                        <li data-tab="about"><a onclick="switchTab('about')">About</a></li>
                    </ul>
                </div>

                <!-- Home Tab Content -->
                <div id="home-content" class="tab-content is-active">
                    <!-- Pinned Section -->
                    <div class="block">
                        <div class="has-text-grey">
                            <i class="fas fa-thumbtack"></i> Pinned
                        </div>
                    </div>

                    <!-- Articles -->
                    <div class="articles-section">
                        <div class="article-card">
                            <div class="columns">
                                <div class="column">
                                    <div class="article-meta">
                                        <span class="tag is-light">Write A Catalyst</span>
                                    </div>
                                    <h2 class="title is-4">Coding vs VIBE Coding</h2>
                                    <p class="subtitle is-6 has-text-grey">Vibe Coding just replaced your job🤷‍♂️</p>
                                    <div class="article-stats">
                                        <span><i class="fas fa-star"></i> Mar 15</span>
                                        <span><i class="fas fa-clap"></i> 3.6K</span>
                                        <span><i class="fas fa-comment"></i> 151</span>
                                    </div>
                                </div>
                                <div class="column is-narrow">
                                    <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=200&h=200&fit=crop"
                                         alt="Article" class="article-image">
                                </div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="columns">
                                <div class="column">
                                    <div class="article-meta">
                                        <span class="tag is-light">JavaScript</span>
                                    </div>
                                    <h2 class="title is-4">Modern JavaScript Patterns for Better Code</h2>
                                    <p class="subtitle is-6 has-text-grey">Exploring ES6+ features that will make your code cleaner and more efficient</p>
                                    <div class="article-stats">
                                        <span><i class="fas fa-star"></i> Mar 10</span>
                                        <span><i class="fas fa-clap"></i> 2.1K</span>
                                        <span><i class="fas fa-comment"></i> 89</span>
                                    </div>
                                </div>
                                <div class="column is-narrow">
                                    <img src="https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=200&h=200&fit=crop"
                                         alt="Article" class="article-image">
                                </div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="columns">
                                <div class="column">
                                    <div class="article-meta">
                                        <span class="tag is-light">Web Development</span>
                                    </div>
                                    <h2 class="title is-4">Building Responsive Layouts with CSS Grid</h2>
                                    <p class="subtitle is-6 has-text-grey">A comprehensive guide to mastering CSS Grid for modern web layouts</p>
                                    <div class="article-stats">
                                        <span><i class="fas fa-star"></i> Mar 5</span>
                                        <span><i class="fas fa-clap"></i> 1.8K</span>
                                        <span><i class="fas fa-comment"></i> 67</span>
                                    </div>
                                </div>
                                <div class="column is-narrow">
                                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=200&h=200&fit=crop"
                                         alt="Article" class="article-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lists Tab Content -->
                <div id="lists-content" class="tab-content">
                    <div class="empty-state">
                        <i class="fas fa-list"></i>
                        <h3 class="title is-4">No lists yet</h3>
                        <p>Create reading lists to organize your favorite stories</p>
                        <button class="button is-primary is-outlined mt-4">Create your first list</button>
                    </div>
                </div>

                <!-- About Tab Content -->
                <div id="about-content" class="tab-content">
                    <div class="content">
                        <h3 class="title is-4">About Adarsh Gupta</h3>
                        <p>
                            I'm a passionate software engineer with over 5 years of experience in JavaScript development.
                            I love sharing knowledge through technical writing and helping developers grow their skills.
                        </p>
                        <p>
                            When I'm not coding, you can find me exploring new technologies, contributing to open source projects,
                            or writing about the latest trends in web development.
                        </p>
                        <h4 class="title is-5">Skills & Interests</h4>
                        <div class="tags">
                            <span class="tag is-primary">JavaScript</span>
                            <span class="tag is-primary">React</span>
                            <span class="tag is-primary">Node.js</span>
                            <span class="tag is-primary">Python</span>
                            <span class="tag is-primary">Technical Writing</span>
                            <span class="tag is-primary">Open Source</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="column is-4">
                <div class="sidebar">
                    <div class="box">
                        <h3 class="title is-6">Recommended topics</h3>
                        <div class="tags">
                            <span class="tag is-light">JavaScript</span>
                            <span class="tag is-light">React</span>
                            <span class="tag is-light">Web Development</span>
                            <span class="tag is-light">Programming</span>
                            <span class="tag is-light">Technology</span>
                        </div>
                        <a href="#" class="has-text-success is-size-7">See all topics</a>
                    </div>

                    <div class="box">
                        <h3 class="title is-6">Who to follow</h3>
                        <div class="media">
                            <div class="media-left">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b6df47c6?w=100&h=100&fit=crop&crop=face"
                                     alt="User" class="following-avatar">
                            </div>
                            <div class="media-content">
                                <p class="has-text-weight-semibold is-size-7">Sarah Johnson</p>
                                <p class="is-size-7 has-text-grey">UX Designer & Writer</p>
                            </div>
                            <div class="media-right">
                                <button class="button is-small is-outlined">Follow</button>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face"
                                     alt="User" class="following-avatar">
                            </div>
                            <div class="media-content">
                                <p class="has-text-weight-semibold is-size-7">Mike Chen</p>
                                <p class="is-size-7 has-text-grey">Frontend Developer</p>
                            </div>
                            <div class="media-right">
                                <button class="button is-small is-outlined">Follow</button>
                            </div>
                        </div>
                        <a href="#" class="has-text-success is-size-7">See all suggestions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Followers Modal -->
    <div id="followersModal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Followers</p>
                <button id="followers-close-btn" class="delete"></button>
            </header>
            <section class="modal-card-body" id="followersContent">
                <!-- Followers content will be loaded here -->
            </section>
        </div>
    </div>

    <!-- Following Modal -->
    <div id="followingModal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Following</p>
                <button id="following-close-btn" class="delete"></button>
            </header>
            <section class="modal-card-body" id="followingContent">
                <!-- Following content will be loaded here -->
            </section>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />

    <script>
         </script>
</body>
</html>
