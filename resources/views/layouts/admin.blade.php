<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Admin Dashboard') - Desa Makmur Sentosa</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Premium Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    @yield('styles')
</head>
<body>

    <div class="admin-wrapper">
        <!-- Sidebar Navigation -->
        <aside class="sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                    <i class="fa-solid fa-mountain-sun"></i>
                    <span>Makmur Admin</span>
                </a>
            </div>
            
            <nav class="sidebar-menu">
                <div class="menu-label">Main Menu</div>
                <ul>
                    <li class="menu-item">
                        <a href="{{ route('admin.dashboard') }}" class="menu-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.apparatus.index') }}" class="menu-link {{ Route::is('admin.apparatus.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users-gear"></i>
                            <span>Perangkat Desa</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.tourism.index') }}" class="menu-link {{ Route::is('admin.tourism.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-umbrella-beach"></i>
                            <span>Wisata & Pariwisata</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.aspiration.index') }}" class="menu-link {{ Route::is('admin.aspiration.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-comments"></i>
                            <span>Aspirasi Warga</span>
                        </a>
                    </li>
                </ul>
                
                <div class="menu-label" style="margin-top: 24px;">Situs Publik</div>
                <ul>
                    <li class="menu-item">
                        <a href="{{ route('home') }}" target="_blank" class="menu-link">
                            <i class="fa-solid fa-globe"></i>
                            <span>Lihat Website</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="sidebar-footer">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Section -->
        <main class="main-content">
            <!-- Top Navbar -->
            <header class="top-navbar">
                <button class="sidebar-toggle-btn" id="sidebarToggle" aria-label="Toggle Sidebar">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
                
                <div class="page-title">
                    <h1>@yield('page_heading', 'Dashboard')</h1>
                    <p>@yield('page_subheading', 'Selamat datang di Panel Administrasi Desa.')</p>
                </div>
                
                <div class="user-profile">
                    <div class="avatar-circle">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="user-name">{{ Auth::user()->name ?? 'Administrator' }}</span>
                </div>
            </header>

            <!-- Alerts / Notifications -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Content Slot -->
            @yield('content')
        </main>
    </div>

    <!-- Layout script for responsive sidebar toggling -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const adminSidebar = document.getElementById('adminSidebar');

            if (sidebarToggle && adminSidebar) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    adminSidebar.classList.toggle('open');
                });

                // Close sidebar when clicking outside of it on mobile
                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 991 && 
                        !adminSidebar.contains(e.target) && 
                        !sidebarToggle.contains(e.target)) {
                        adminSidebar.classList.remove('open');
                    }
                });
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>
