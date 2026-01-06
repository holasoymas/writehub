<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Medium Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 250px;
        }

        body {
            background-color: #f5f7fa;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 30;
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }

        .admin-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: bold;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.1);
            border-left-color: white;
        }

        .sidebar-menu a.is-active {
            background: rgba(255,255,255,0.15);
            border-left-color: white;
            color: white;
        }

        .sidebar-menu i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }

        .admin-navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-main {
            padding: 2rem;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }

        .stat-card {
            border-left: 4px solid;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .stat-card.is-primary {
            border-left-color: #667eea;
        }

        .stat-card.is-success {
            border-left-color: #48c774;
        }

        .stat-card.is-warning {
            border-left-color: #ffdd57;
        }

        .stat-card.is-danger {
            border-left-color: #f14668;
        }

        .burger-menu {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #363636;
        }

        @media screen and (max-width: 1023px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.is-active {
                transform: translateX(0);
            }

            .admin-content {
                margin-left: 0;
            }

            .burger-menu {
                display: block;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 25;
            }

            .sidebar-overlay.is-active {
                display: block;
            }
        }

        .table-container {
            overflow-x: auto;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="sidebar">
            <div class="sidebar-brand">
                <i class="fas fa-blog"></i> Blog Admin
            </div>
            <nav class="sidebar-menu">
                <a href="/admin/analytics" class="{{ Request::is('admin/analytics') ? 'is-active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Analytics</span>
                </a>
                <a href="/admin/users" class="{{ Request::is('admin/users') ? 'is-active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="/admin/posts" class="{{ Request::is('admin/posts') ? 'is-active' : '' }}">
                    <i class="fas fa-newspaper"></i>
                    <span>Posts</span>
                </a>
                <a href="/admin/reports" class="{{ Request::is('admin/reports') ? 'is-active' : '' }}">
                    <i class="fas fa-flag"></i>
                    <span>Reported Posts</span>
                </a>
                <a href="/admin/broadcast" class="{{ Request::is('admin/broadcast') ? 'is-active' : '' }}">
                    <i class="fas fa-bullhorn"></i>
                    <span>Broadcast</span>
                </a>
                <a href="/admin/logout" style="margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </nav>
        </aside>

        <!-- Overlay for mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <div class="admin-content">
            <!-- Top Navbar -->
            <nav class="admin-navbar">
                <div>
                    <button class="burger-menu" id="burgerMenu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span class="is-size-5 has-text-weight-semibold ml-2">@yield('page-title', 'Dashboard')</span>
                </div>
                <div class="is-flex is-align-items-center">
                    <span class="mr-3">Welcome, <strong>Admin</strong></span>
                </div>
            </nav>

            <!-- Main Content Area -->
            <main class="admin-main">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const burgerMenu = document.getElementById('burgerMenu');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        burgerMenu.addEventListener('click', () => {
            sidebar.classList.toggle('is-active');
            sidebarOverlay.classList.toggle('is-active');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.remove('is-active');
            sidebarOverlay.classList.remove('is-active');
        });

        // Delete confirmation
        function confirmDelete(itemType) {
            return confirm(`Are you sure you want to delete this ${itemType}?`);
        }

        // Broadcast message alert
        function showBroadcastSuccess() {
            alert('Broadcast message sent successfully to all users!');
        }
    </script>
</body>
</html>
