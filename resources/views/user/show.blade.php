<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adarsh Gupta - Medium</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .profile-avatar {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .navbar-brand .navbar-item {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .profile-header {
            padding: 2rem 0;
        }

        .profile-stats {
            color: #6b7280;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .profile-stats:hover {
            color: #059669;
        }

        .profile-bio {
            margin: 1rem 0;
            color: #6b7280;
        }

        .profile-links a {
            color: #059669;
            text-decoration: none;
        }

        .profile-links a:hover {
            text-decoration: underline;
        }

        .tabs {
            border-bottom: 1px solid #e5e7eb;
        }

        .tab-content {
            display: none;
            padding: 2rem 0;
        }

        .tab-content.is-active {
            display: block;
        }

        .article-card {
            border-bottom: 1px solid #e5e7eb;
            padding: 1.5rem 0;
        }

        .article-meta {
            color: #6b7280;
            font-size: 0.85rem;
        }

        .article-stats {
            color: #6b7280;
            font-size: 0.85rem;
        }

        .article-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
        }

        .following-card {
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-bottom: 1rem;
        }

        .following-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .write-btn {
            background-color: #059669;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .write-btn:hover {
            background-color: #047857;
            color: white;
        }

        .sidebar {
            position: sticky;
            top: 2rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .footer {
            background-color: #fafafa;
            border-top: 1px solid #e5e7eb;
            margin-top: 4rem;
            padding: 3rem 0;
        }

        .footer-links {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .footer-links a {
            color: #6b7280;
            text-decoration: none;
            margin-right: 1rem;
        }

        .footer-links a:hover {
            color: #059669;
        }

        @media (max-width: 768px) {
            .profile-header {
                text-align: center;
            }

            .article-image {
                width: 80px;
                height: 80px;
            }

            .sidebar {
                position: static;
                margin-top: 2rem;
            }

            .columns.is-desktop {
                display: block;
            }
        }

        .modal-card {
            max-height: 80vh;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar is-white" role="navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="#">
                   WriteHub
                </a>
                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div id="navbarMenu" class="navbar-menu">
                <div class="navbar-start">
                    <div class="navbar-item">
                        <div class="field has-addons">
                            <div class="control has-icons-left">
                                <input class="input" type="text" placeholder="Search">
                                <span class="icon is-left">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navbar-end">
                    <div class="navbar-item">
                        <a href="#" class="write-btn">
                            <i class="fas fa-pen"></i> Write
                        </a>
                    </div>
                    <div class="navbar-item">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face"
                             alt="Profile" class="profile-avatar" style="width: 32px; height: 32px;">
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="columns is-desktop">
            <!-- Main Content -->
            <div class="column is-8">
                <!-- Profile Header -->
                <div class="profile-header">
                    <div class="columns is-vcentered">
                        <div class="column is-narrow">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=200&h=200&fit=crop&crop=face"
                                 alt="Adarsh Gupta" class="profile-avatar">
                        </div>
                        <div class="column">
                            <h1 class="title is-2">{{ $user->name }}</h1>
                            <div class="profile-stats">
                                <span onclick="showFollowersModal()" style="margin-right: 1rem;">{{ $user->followers_count }} followers</span>
                                <span onclick="showFollowingModal()">{{ $user->followings_count }} following</span>
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
        <div class="modal-background" onclick="closeModal('followersModal')"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Followers</p>
                <button class="delete" onclick="closeModal('followersModal')"></button>
            </header>
            <section class="modal-card-body" id="followersContent">
                <!-- Followers content will be loaded here -->
            </section>
        </div>
    </div>

    <!-- Following Modal -->
    <div id="followingModal" class="modal">
        <div class="modal-background" onclick="closeModal('followingModal')"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Following</p>
                <button class="delete" onclick="closeModal('followingModal')"></button>
            </header>
            <section class="modal-card-body" id="followingContent">
                <!-- Following content will be loaded here -->
            </section>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="columns">
                <div class="column is-6">
                    <h5 class="title is-5">Medium</h5>
                    <p class="has-text-grey">A place to read, write, and deepen your understanding</p>
                </div>
                <div class="column is-6">
                    <div class="footer-links">
                        <a href="#">About</a>
                        <a href="#">Write</a>
                        <a href="#">Help</a>
                        <a href="#">Legal</a>
                        <a href="#">Privacy</a>
                        <a href="#">Terms</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="has-text-centered has-text-grey">
                <p>&copy; 2024 Medium. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', () => {
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

            if ($navbarBurgers.length > 0) {
                $navbarBurgers.forEach(el => {
                    el.addEventListener('click', () => {
                        const target = el.dataset.target;
                        const $target = document.getElementById(target);

                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');
                    });
                });
            }
        });

        // Tab switching functionality
        function switchTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => {
                content.classList.remove('is-active');
            });

            // Remove active class from all tabs
            const tabs = document.querySelectorAll('.tabs li');
            tabs.forEach(tab => {
                tab.classList.remove('is-active');
            });

            // Show selected tab content
            document.getElementById(tabName + '-content').classList.add('is-active');

            // Add active class to selected tab
            document.querySelector(`[data-tab="${tabName}"]`).classList.add('is-active');
        }

        // Modal functions
        function showFollowersModal() {
            const modal = document.getElementById('followersModal');
            const content = document.getElementById('followersContent');

            // Sample followers data
            const followers = [
                { name: 'Sarah Johnson', bio: 'UX Designer & Writer', avatar: 'https://images.unsplash.com/photo-1494790108755-2616b6df47c6?w=100&h=100&fit=crop&crop=face' },
                { name: 'Mike Chen', bio: 'Frontend Developer', avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face' },
                { name: 'Emily Davis', bio: 'Product Manager', avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face' },
                { name: 'Alex Rodriguez', bio: 'Data Scientist', avatar: 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=100&h=100&fit=crop&crop=face' }
            ];

            content.innerHTML = followers.map(follower => `
                <div class="media">
                    <div class="media-left">
                        <img src="${follower.avatar}" alt="${follower.name}" class="following-avatar">
                    </div>
                    <div class="media-content">
                        <p class="has-text-weight-semibold">${follower.name}</p>
                        <p class="is-size-7 has-text-grey">${follower.bio}</p>
                    </div>
                    <div class="media-right">
                        <button class="button is-small is-outlined">Follow back</button>
                    </div>
                </div>
            `).join('');

            modal.classList.add('is-active');
        }

        function showFollowingModal() {
            const modal = document.getElementById('followingModal');
            const content = document.getElementById('followingContent');

            // Sample following data
            const following = [
                { name: 'Code Like A Girl', bio: 'Empowering women in tech', avatar: 'https://images.unsplash.com/photo-1494790108755-2616b6df47c6?w=100&h=100&fit=crop&crop=face' },
                { name: 'Better Humans', bio: 'Better Living Through Technology', avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face' },
                { name: 'Let\'s Code Future', bio: 'Programming tutorials and tips', avatar: 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=100&h=100&fit=crop&crop=face' }
            ];

            content.innerHTML = following.map(user => `
                <div class="media">
                    <div class="media-left">
                        <img src="${user.avatar}" alt="${user.name}" class="following-avatar">
                    </div>
                    <div class="media-content">
                        <p class="has-text-weight-semibold">${user.name}</p>
                        <p class="is-size-7 has-text-grey">${user.bio}</p>
                    </div>
                    <div class="media-right">
                        <button class="button is-small is-danger is-outlined">Unfollow</button>
                    </div>
                </div>
            `).join('');

            modal.classList.add('is-active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('is-active');
        }
    </script>
</body>
</html>
