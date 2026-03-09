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
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/profile.dropdown.css') }}">
        <link rel="stylesheet" href="{{ asset('css/error-box.css') }}">
        <script type="module" src="{{ asset('js/navbar.js') }}"></script>
        {{-- <script type="module" src="{{ asset('js/show.profile.js') }}"></script> --}}

        @vite(['resources/js/dropdown.js'])
        @vite(['resources/js/followers.js'])
        @vite(['resources/js/follow-unfollow.js'])
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
                    const book = @json($bookmarkedUserPosts);
                    console.log(data)
                    console.log(book)
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
                                    @if ($user->id == Auth::id())
                                        <li data-tab="lists-content"><a onclick="switchTab('lists-content')">Favorite Posts</a></li>
                                    @endif
                                </ul>
                            </div>

                            <!-- Home Tab Content -->
                            <div id="home-content" class="tab-content is-active">
                                <!-- Articles -->
                                    <x-list-post :userPosts="$user->posts" />
                            </div>

                            <!-- Lists Tab Content -->
                            <div id="lists-content" class="tab-content">
                                    <x-list-post :userPosts="$bookmarkedUserPosts" />
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

                                    {{-- <a href="#" class="has-text-success is-size-7">See all topics</a> --}}
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
                                                {{-- <button class="button is-small is-outlined" data-user-id="{{$suggestion->id}}">Follow</button> --}}
                                                <button class="follow-btn" data-user-id="{{ $suggestion->id }}">Follow</button>
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
