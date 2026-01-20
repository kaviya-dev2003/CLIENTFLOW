<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CLIENTFLOW')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    
    @yield('styles')
</head>
<body>

    @auth
    <aside class="sidebar">
        <div class="sidebar-logo">
            <i class="bi bi-stack"></i> CLIENTFLOW
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> Dashboard
            </a>
            @can('view project')
            <a href="{{ route('projects') }}" class="sidebar-link {{ request()->routeIs('projects') ? 'active' : '' }}">
                <i class="bi bi-briefcase"></i> Projects
            </a>
            @endcan
            @can('view client')
            <a href="{{ route('clients') }}" class="sidebar-link {{ request()->routeIs('clients') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Clients & Finance
            </a>
            @endcan
            <a href="#" class="sidebar-link">
                <i class="bi bi-gear"></i> Settings
            </a>
        </nav>
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link w-100 border-0 bg-transparent text-start">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>
    @else
        @yield('content')
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
