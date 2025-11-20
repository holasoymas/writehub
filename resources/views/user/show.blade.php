<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $user->name }} - Writehub</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <link rel="stylesheet" href="{{ asset('css/show.profile.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/profile.dropdown.css') }}">
        <link rel="stylesheet" href="{{ asset('css/error-box.css') }}">
        <script type="module" src="{{ asset('js/navbar.js') }}"></script>
        {{-- <script type="module" src="{{ asset('js/show.profile.js') }}"></script> --}}

        @vite(['resources/js/dropdown.js'])
        @vite(['resources/js/followers.js'])
        @vite(['resources/js/searchInput.js'])
        @vite(['resources/js/report.js'])
    </head>
    <body>
        <!-- Navigation / navbar -->
        <x-navbar user="Auth::user()" />

            {{-- for displaying errors  --}}
            <x-error-box />

                <script>
                    const data = @json($user->posts);
                    console.log(data)
                </script>

                <div class="container">
                    <div class="columns is-desktop mx-2">
                        <!-- Main Content -->
                        <div class="column is-8">
                            <!-- Profile Header -->
                            <div class="profile-header" data-user-id="{{ $user->id }}">
                                <div class="columns is-vcentered">
                                    <div class="column is-narrow">
                                        <img src="{{ $user->profile_pic }}"
                                             alt="{{ $user->name }}" class="profile-avatar">
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
                                                <div class="column is-narrow follow-btn-div">
                                                    <form method="POST" action='{{ route('user.unfollow', ['user' => $user ]) }}'>
                                                        @csrf
                                                        @method("DELETE")
                                                        <button class="button is-dark is-rounded">Following</button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="column is-narrow follow-btn-div">
                                                    <form method="POST" action='{{ route('user.follow', ['user' => $user ]) }}'>
                                                        @csrf
                                                        <button class="button is-dark is-rounded">Follow</button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    @else
                                        <div class="column is-narrow follow-btn-div">
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
                                    <li class="is-active" data-tab="home-content"><a onclick="switchTab('home-content')">Home</a></li>
                                    <li data-tab="lists-content"><a onclick="switchTab('lists-content')">Lists</a></li>
                                    <li data-tab="about-content"><a onclick="switchTab('about-content')">About</a></li>
                                </ul>
                            </div>

                            <!-- Home Tab Content -->
                            <div id="home-content" class="tab-content is-active">

                                <!-- Articles -->
                                <div class="articles-section">
                                    @forelse ($user->posts as $item)
                                        @php
                                         $blocks = $item->content; // already in array if casted in model
                                         $firstPara = collect($blocks)->firstWhere('type', 'paragraph');
                                         $firstImage = collect($blocks)->firstWhere('type', 'image');
                                    @endphp
                                    <div class="article-card" data-post-id="{{ $item->id }}">
                                        <header class="card-header">
                                            <p class="card-header-title">
                                            <img src="{{ $user->profile_pic }}" class="profile-avatar" style="width: 22px; height: 22px;" />
                                            <a href="{{ route('user.show', $user->id)}}" style="margin-left:5px;color:black;">{{ $user->name }}</a>
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

                                @empty
                                    <h1> No post found </h1>
                                @endforelse
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

                                    <!-- rendering tags dynamic -->
                                    <div class="tags">
                                        @foreach ($recommendedTags as $tag)
                                            <span class="tag is-light">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>

                                    <a href="#" class="has-text-success is-size-7">See all topics</a>
                                </div>

                                <div class="box">
                                    <h3 class="title is-6">Who to follow</h3>
                                    @foreach ($friendSuggestions as $suggestion)
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{ $suggestion->profile_pic }}"
                                                     alt="User" class="following-avatar">
                                            </div>
                                            <div class="media-content">
                                                <p class="has-text-weight-semibold is-size-7">
                                                   <a style="color:black;" href={{ route('user.show', $suggestion->id) }}>
                                                    {{ $suggestion->name }}
                                                   </a>
                                                </p>
                                                <p class="is-size-7 has-text-grey">{{ $suggestion?->bio }}</p>
                                            </div>
                                            <div class="media-right">
                                                <button class="button is-small is-outlined" data-user-id="{{$suggestion->id}}">Follow</button>
                                            </div>
                                        </div>
                                    @endforeach
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

                {{-- Report modal  --}}
                <div class="modal" id="report-modal">
                    <div class="modal-background"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Report</p>
                            <button class="delete" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body">

                            <div class="control report-reason">
                                <label class="radio is-medium">
                                    <input type="radio" name="report_reason" value="misinformation" />
                                    Misinformation
                                </label> <br />
                                <label class="radio">
                                    <input type="radio" name="report_reason" value="low_quality"  />
                                    Low Quality
                                </label> <br />
                                <label class="radio" >
                                    <input type="radio" name="report_reason" value="sexual_content" />
                                    Sexual Content
                                </label><br />
                                <label class="radio" >
                                    <input type="radio" name="report_reason" value="other" id="other-reason" />
                                    Other
                                </label><br />
                                <input type="text" class="input" placeholder="Specify reason" name="other-reason" id="other-reason-input" style="display:none;" />
                            </div>
                        </section>
                        <footer class="modal-card-foot">
                            <div class="buttons">
                                <button class="button is-success">Report</button>
                                <button class="button">Cancel</button>
                            </div>
                        </footer>
                    </div>
                </div>


                <!-- Footer -->
                <x-footer />

                <script>
                    function switchTab(tabName) {
                            // hide all contents
                        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('is-active'));

                        // remove active state from all tabs
                        document.querySelectorAll('.tabs li').forEach(el => el.classList.remove('is-active'));

                        // show selected content
                        document.getElementById(tabName).classList.add('is-active');

                        // set active tab
                        document.querySelector(`.tabs li[data-tab="${tabName}"]`).classList.add('is-active');
                    }
                </script>
    </body>
</html>
