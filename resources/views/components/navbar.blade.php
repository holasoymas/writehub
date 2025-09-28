    <nav class="navbar is-white" role="navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ route('home') }}">
                   WriteHub
                </a>
                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

             <div id="navbarMenu" class="navbar-menu">
      <!-- Keep search centered or in middle -->
      <div class="navbar-start" style="flex:1; justify-content: center;">
        <div class="navbar-item" style="flex: 1; max-width: 500px; position: relative; border-radius: 18px;">
          <div class="field" style="width: 100%;">
            <div class="control has-icons-left" style="width: 100%;">
              <input class="input" id="usersearchinput" name="userinput" autocomplete="off"
                     type="text" placeholder="Search blogs..." style="width: 100%;">
              <span class="icon is-left">
                <i class="fas fa-search"></i>
              </span>

              <!-- Suggestion Box -->
              <div id="suggestions-box" class="box"
                   style="position: absolute; top: 100%; left: 0; width: 100%; display: none;
                          z-index: 1000; max-height: 250px; overflow-y: auto;">
                <!-- Suggestions go here -->
              </div>
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
                        <div class="dropdown profile-dropdown">
                            <div class="dropdown-trigger">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face"
                                alt="Profile" class="profile-avatar" style="width: 32px; height: 32px;">
                            </div>

                        <!-- Dropdown menu container -->
                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <!-- User information section -->
                                <div class="user-info">
                                    <div class="user-name">John Doe</div>
                                    <div class="user-email">john.doe@example.com</div>
                                </div>

                                <!-- Profile related actions -->
                                <a href="#" class="dropdown-item nav">
                                    <i class="fas fa-user"></i>
                                    <span>View Profile</span>
                                </a>

                                <a href="#" class="dropdown-item nav">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit Profile</span>
                                </a>

                                <a href="#" class="dropdown-item nav">
                                    <i class="fas fa-key"></i>
                                    <span>Change Password</span>
                                </a>

                                <!-- Account settings -->
                                <a href="#" class="dropdown-item nav">
                                    <i class="fas fa-palette"></i>
                                    <span>Preferences</span>
                                </a>

                                <a href="#" class="dropdown-item nav">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Privacy & Security</span>
                                </a>

                                <!-- Divider line -->
                                <hr class="dropdown-divider">

                                <!-- Help and support section -->
                                <a href="#" class="dropdown-item nav">
                                    <i class="fas fa-question-circle"></i>
                                    <span>Help & Support</span>
                                </a>

                                <a href="#" class="dropdown-item nav">
                                    <i class="fas fa-info-circle"></i>
                                    <span>About</span>
                                </a>

                                <!-- Divider before logout -->
                                <hr class="dropdown-divider">

                                <!-- Logout action (styled differently) -->
                                <a href="#" class="dropdown-item nav logout-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


