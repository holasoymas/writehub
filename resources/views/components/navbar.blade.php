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
                        <a href="{{ route('posts.create') }}" class="write-btn">
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


