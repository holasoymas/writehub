<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Writehub - Discover Stories</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <style>

.hero-section {
    background: linear-gradient(135deg, #1A8917 0%, #4a9e4a 20%, #a3d9a5 60%, #e8f5e8 100%);
    color: #292929;
    padding: 4rem 0;
}
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .trending-section {
            padding: 2rem 0;
            border-bottom: 1px solid var(--border-light);
        }

        .trending-title {
            display: flex;
            align-items: center;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }

        .trending-icon {
            margin-right: 0.5rem;
            color: #ffd700;
        }

        .trending-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .trending-number {
            font-size: 2rem;
            font-weight: 700;
            color: #e6e6e6;
            margin-right: 1rem;
            min-width: 3rem;
        }

        .trending-content h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .trending-meta {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .trending-meta .author {
            font-weight: 500;
            color: var(--primary-color);
            margin-right: 0.5rem;
        }

        .trending-meta .date {
            margin: 0 0.5rem;
        }

        .article-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 4rem;
            padding: 2rem 0;
        }

        .article-card {
            display: flex;
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--border-light);
            transition: all 0.2s ease;
        }

        .article-card:hover {
            background-color: var(--hover-bg);
            margin: 0 -1rem;
            padding-left: 1rem;
            padding-right: 1rem;
            border-radius: 8px;
        }

        .article-content {
            flex: 1;
            margin-right: 2rem;
        }

        .article-author {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .author-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            margin-right: 0.5rem;
        }

        .author-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--primary-color);
        }

        .article-title {
            font-size: 1.375rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .article-excerpt {
            font-size: 1rem;
            color: var(--text-light);
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .article-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .article-meta {
            display: flex;
            align-items: center;
        }

        .article-meta span {
            margin-right: 1rem;
        }

        .article-tag {
            background-color: #f2f2f2;
            color: var(--text-light);
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            margin-right: 0.5rem;
        }

        .article-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 4px;
        }

        .sidebar {
            position: sticky;
            top: 2rem;
        }

        .sidebar-section {
            background: white;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .sidebar-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .topic-tag {
            display: inline-block;
            background-color: #f2f2f2;
            color: var(--text-light);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            margin: 0.25rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .topic-tag:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .follow-suggestion {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .follow-suggestion:last-child {
            border-bottom: none;
        }

        .follow-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 0.75rem;
        }

        .follow-info {
            flex: 1;
        }

        .follow-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .follow-bio {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .follow-btn {
            background: none;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .follow-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        .footer {
            background-color: #f8f9fa;
            border-top: 1px solid var(--border-light);
            padding: 2rem 0;
            margin-top: 4rem;
        }

        .footer-links {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-links a {
            color: var(--text-light);
            font-size: 0.875rem;
            text-decoration: none;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .article-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .article-card {
                flex-direction: column;
            }

            .article-content {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .article-image {
                width: 100%;
                height: 200px;
            }

            .trending-item {
                flex-direction: column;
            }

            .trending-number {
                margin-bottom: 0.5rem;
            }

            .sidebar {
                position: static;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                padding: 2rem 0;
            }

            .hero-title {
                font-size: 2rem;
            }

            .article-title {
                font-size: 1.25rem;
            }

            .trending-section {
                padding: 1rem 0;
            }
        }
        </style>
        <link rel="stylesheet" href="{{ asset('css/show.profile.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/profile.dropdown.css') }}">
        {{-- <script type="module" src="{{ asset('js/show.profile.js') }}"></script> --}}

        @vite(['resources/js/dropdown.js'])

    </head>
    <body>
        <!-- Navigation -->

        {{-- <x-navbar /> --}}

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
                        <div class="column is-4">
                            <div class="trending-item">
                                <div class="trending-number">01</div>
                                <div class="trending-content">
                                    <h3>The Future of AI: What Every Developer Should Know</h3>
                                    <div class="trending-meta">
                                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=20&h=20&fit=crop&crop=face"
                                             alt="Author" class="author-avatar">
                                        <span class="author">Alex Chen</span>
                                        <span class="date">Dec 27</span>
                                        <span>5 min read</span>
                                        <i class="fas fa-star" style="margin-left: 0.5rem; color: #ffd700;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="trending-item">
                                <div class="trending-number">02</div>
                                <div class="trending-content">
                                    <h3>Building Scalable React Applications in 2025</h3>
                                    <div class="trending-meta">
                                        <img src="https://images.unsplash.com/photo-1494790108755-2616b6df47c6?w=20&h=20&fit=crop&crop=face"
                                             alt="Author" class="author-avatar">
                                        <span class="author">Sarah Kim</span>
                                        <span class="date">Dec 26</span>
                                        <span>8 min read</span>
                                        <i class="fas fa-star" style="margin-left: 0.5rem; color: #ffd700;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="trending-item">
                                <div class="trending-number">03</div>
                                <div class="trending-content">
                                    <h3>Why Remote Work is Here to Stay</h3>
                                    <div class="trending-meta">
                                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=20&h=20&fit=crop&crop=face"
                                             alt="Author" class="author-avatar">
                                        <span class="author">Mike Johnson</span>
                                        <span class="date">Dec 25</span>
                                        <span>6 min read</span>
                                        <i class="fas fa-star" style="margin-left: 0.5rem; color: #ffd700;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="trending-item">
                                <div class="trending-number">04</div>
                                <div class="trending-content">
                                    <h3>Mastering CSS Grid: A Complete Guide</h3>
                                    <div class="trending-meta">
                                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=20&h=20&fit=crop&crop=face"
                                             alt="Author" class="author-avatar">
                                        <span class="author">Emma Davis</span>
                                        <span class="date">Dec 24</span>
                                        <span>12 min read</span>
                                        <i class="fas fa-star" style="margin-left: 0.5rem; color: #ffd700;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="trending-item">
                                <div class="trending-number">05</div>
                                <div class="trending-content">
                                    <h3>The Psychology of User Interface Design</h3>
                                    <div class="trending-meta">
                                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=20&h=20&fit=crop&crop=face"
                                             alt="Author" class="author-avatar">
                                        <span class="author">David Park</span>
                                        <span class="date">Dec 23</span>
                                        <span>7 min read</span>
                                        <i class="fas fa-star" style="margin-left: 0.5rem; color: #ffd700;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="trending-item">
                                <div class="trending-number">06</div>
                                <div class="trending-content">
                                    <h3>Blockchain Beyond Cryptocurrency</h3>
                                    <div class="trending-meta">
                                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=20&h=20&fit=crop&crop=face"
                                             alt="Author" class="author-avatar">
                                        <span class="author">Lisa Wang</span>
                                        <span class="date">Dec 22</span>
                                        <span>9 min read</span>
                                        <i class="fas fa-star" style="margin-left: 0.5rem; color: #ffd700;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Articles Grid -->
                <div class="article-grid">
                    <!-- Main Articles -->
                    <div class="articles-main">
                        <!-- Article 1 -->
                        <article class="article-card">
                            <div class="article-content">
                                <div class="article-author">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=24&h=24&fit=crop&crop=face"
                                         alt="Author" class="author-avatar">
                                    <span class="author-name">John Doe</span>
                                </div>

 <div class="dropdown is-right" id="dropdown-article-action">
          <div class="dropdown-trigger">
            <button class="button is-white" aria-haspopup="true" aria-controls="dropdown-options">
              <span class="icon is-small">⋮</span>
            </button>
          </div>
          <div class="dropdown-menu" id="dropdown-options" role="menu">
            <div class="dropdown-content">
              <a class="dropdown-item">Update Post</a>
              <a class="dropdown-item">Delete Post</a>
              <a class="dropdown-item">Share</a>
            </div>
          </div>
        </div>

                                <h2 class="article-title">The Complete Guide to Modern JavaScript Development</h2>
                                <p class="article-excerpt">
                                Exploring the latest features and best practices in JavaScript development. From ES6+
                                syntax to advanced patterns that will make your code more efficient and maintainable.
                                </p>
                                <div class="article-footer">
                                    <div class="article-meta">
                                        <span class="article-tag">JavaScript</span>
                                        <span>Dec 28 · 8 min read</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                </div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=120&h=120&fit=crop"
                                 alt="Article" class="article-image">
                        </article>

                        <!-- Article 2 -->
                        <article class="article-card">
                            <div class="article-content">
                                <div class="article-author">
                                    <img src="https://images.unsplash.com/photo-1494790108755-2616b6df47c6?w=24&h=24&fit=crop&crop=face"
                                         alt="Author" class="author-avatar">
                                    <span class="author-name">Jane Smith</span>
                                </div>
                                <h2 class="article-title">Design Systems That Scale: Lessons from Top Tech Companies</h2>
                                <p class="article-excerpt">
                                How companies like Airbnb, Uber, and Spotify built design systems that serve millions
                                of users. Key principles and practical implementation strategies.
                                </p>
                                <div class="article-footer">
                                    <div class="article-meta">
                                        <span class="article-tag">Design</span>
                                        <span>Dec 27 · 6 min read</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                </div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=120&h=120&fit=crop"
                                 alt="Article" class="article-image">
                        </article>

                        <!-- Article 3 -->
                        <article class="article-card">
                            <div class="article-content">
                                <div class="article-author">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=24&h=24&fit=crop&crop=face"
                                         alt="Author" class="author-avatar">
                                    <span class="author-name">Mike Johnson</span>
                                </div>
                                <h2 class="article-title">The Rise of Edge Computing: What Developers Need to Know</h2>
                                <p class="article-excerpt">
                                Edge computing is transforming how we build applications. Understanding the fundamentals
                                and practical applications in modern web development.
                                </p>
                                <div class="article-footer">
                                    <div class="article-meta">
                                        <span class="article-tag">Technology</span>
                                        <span>Dec 26 · 7 min read</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                </div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=120&h=120&fit=crop"
                                 alt="Article" class="article-image">
                        </article>

                        <!-- Article 4 -->
                        <article class="article-card">
                            <div class="article-content">
                                <div class="article-author">
                                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=24&h=24&fit=crop&crop=face"
                                         alt="Author" class="author-avatar">
                                    <span class="author-name">Emma Davis</span>
                                </div>
                                <h2 class="article-title">Building Accessible Web Applications: A Comprehensive Guide</h2>
                                <p class="article-excerpt">
                                Web accessibility is not optional. Learn how to build inclusive applications that work
                                for everyone, with practical examples and testing strategies.
                                </p>
                                <div class="article-footer">
                                    <div class="article-meta">
                                        <span class="article-tag">Accessibility</span>
                                        <span>Dec 25 · 10 min read</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                </div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1559028006-448665bd7c7f?w=120&h=120&fit=crop"
                                 alt="Article" class="article-image">
                        </article>

                        <!-- Article 5 -->
                        <article class="article-card">
                            <div class="article-content">
                                <div class="article-author">
                                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=24&h=24&fit=crop&crop=face"
                                         alt="Author" class="author-avatar">
                                    <span class="author-name">Lisa Wang</span>
                                </div>
                                <h2 class="article-title">The Future of Work: Remote Collaboration Tools That Actually Work</h2>
                                <p class="article-excerpt">
                                After years of remote work experimentation, we've learned what tools and practices
                                truly enable productive distributed teams.
                                </p>
                                <div class="article-footer">
                                    <div class="article-meta">
                                        <span class="article-tag">Productivity</span>
                                        <span>Dec 24 · 5 min read</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                </div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=120&h=120&fit=crop"
                                 alt="Article" class="article-image">
                        </article>
                    </div>

                    <!-- Sidebar -->
                    <aside class="sidebar">
                        <!-- Discover Topics -->
                        <div class="sidebar-section">
                            <h3 class="sidebar-title">Discover more of what matters to you</h3>
                            <div>
                                <a href="#" class="topic-tag">Programming</a>
                                <a href="#" class="topic-tag">Data Science</a>
                                <a href="#" class="topic-tag">Technology</a>
                                <a href="#" class="topic-tag">Self Improvement</a>
                                <a href="#" class="topic-tag">Writing</a>
                                <a href="#" class="topic-tag">Relationships</a>
                                <a href="#" class="topic-tag">Machine Learning</a>
                                <a href="#" class="topic-tag">Productivity</a>
                                <a href="#" class="topic-tag">Politics</a>
                            </div>
                            <div style="margin-top: 1rem;">
                                <a href="#" style="color: #1a8917; font-size: 0.875rem; font-weight: 500;">See more topics</a>
                            </div>
                        </div>

                        <!-- Who to Follow -->
                        <div class="sidebar-section">
                            <h3 class="sidebar-title">Who to follow</h3>
                            <div class="follow-suggestion">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b6df47c6?w=40&h=40&fit=crop&crop=face"
                                     alt="User" class="follow-avatar">
                                <div class="follow-info">
                                    <div class="follow-name">Sarah Johnson</div>
                                    <div class="follow-bio">UX Designer & Tech Writer</div>
                                </div>
                                <button class="follow-btn">Follow</button>
                            </div>
                            <div class="follow-suggestion">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop&crop=face"
                                     alt="User" class="follow-avatar">
                                <div class="follow-info">
                                    <div class="follow-name">Alex Chen</div>
                                    <div class="follow-bio">AI Researcher & Developer</div>
                                </div>
                                <button class="follow-btn">Follow</button>
                            </div>
                            <div class="follow-suggestion">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face"
                                     alt="User" class="follow-avatar">
                                <div class="follow-info">
                                    <div class="follow-name">Mike Rodriguez</div>
                                    <div class="follow-bio">Frontend Engineer</div>
                                </div>
                                <button class="follow-btn">Follow</button>
                            </div>
                            <div style="margin-top: 1rem;">
                                <a href="#" style="color: #1a8917; font-size: 0.875rem; font-weight: 500;">See all suggestions</a>
                            </div>
                        </div>

                        <!-- Recently Saved -->
                        <div class="sidebar-section">
                            <h3 class="sidebar-title">Reading list</h3>
                            <p style="font-size: 0.875rem; color: #6b6b6b; margin-bottom: 1rem;">
                            Click the bookmark icon to save stories for later.
                            </p>
                            <div style="text-align: center; padding: 2rem 0;">
                                <i class="fas fa-bookmark" style="font-size: 3rem; color: #e6e6e6;"></i>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="container">
                    <div class="footer-links">
                        <a href="#">Help</a>
                        <a href="#">Status</a>
                        <a href="#">Writers</a>
                        <a href="#">Blog</a>
                        <a href="#">Careers</a>
                        <a href="#">Privacy</a>
                        <a href="#">Terms</a>
                        <a href="#">About</a>
                        <a href="#">Text to speech</a>
                    </div>
                </div>
            </footer>

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

                // Smooth scrolling for anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
