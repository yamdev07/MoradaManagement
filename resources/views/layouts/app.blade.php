<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Administration</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Bootstrap CSS (CDN) - Rapide et fiable -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons (si utilisé) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js (pour les graphiques) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSS Assets -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Fallback CSS personnalisé (si Vite ne charge pas) -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Styles Morada Lodge -->
    <style>
        :root {
            /* Couleurs Morada Lodge */
            --morada-primary: #8b4513;
            --morada-secondary: #a0522d;
            --morada-accent: #cd853f;
            --morada-dark: #654321;
            --morada-light: #f4f1e8;
            --morada-warm: #f5e6d3;
        }
        
        /* Navbar Morada Lodge */
        .navbar {
            background-color: var(--morada-light) !important;
            border-bottom: 2px solid var(--morada-primary);
        }
        
        .navbar-brand {
            color: var(--morada-primary) !important;
            font-weight: 700;
        }
        
        .nav-link {
            color: var(--morada-dark) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--morada-primary) !important;
            background-color: var(--morada-warm);
            border-radius: 5px;
        }
        
        .nav-link.active {
            color: var(--morada-primary) !important;
            background-color: var(--morada-warm);
            border-radius: 5px;
        }
        
        /* Dropdown menus */
        .dropdown-menu {
            border: 1px solid var(--morada-accent);
            box-shadow: 0 4px 8px rgba(139, 69, 19, 0.1);
        }
        
        .dropdown-item {
            color: var(--morada-dark);
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background-color: var(--morada-warm);
            color: var(--morada-primary);
        }
        
        /* Body */
        body {
            background-color: var(--morada-light);
            color: var(--morada-dark);
        }
        
        /* Cards */
        .card {
            border: 1px solid var(--morada-accent);
            box-shadow: 0 2px 4px rgba(139, 69, 19, 0.1);
        }
        
        .card-header {
            background-color: var(--morada-primary);
            color: white;
            border-bottom: 1px solid var(--morada-secondary);
        }
        
        /* Buttons */
        .btn-primary {
            background-color: var(--morada-primary);
            border-color: var(--morada-primary);
        }
        
        .btn-primary:hover {
            background-color: var(--morada-secondary);
            border-color: var(--morada-secondary);
        }
        
        .btn-outline-primary {
            color: var(--morada-primary);
            border-color: var(--morada-primary);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--morada-primary);
            border-color: var(--morada-primary);
            color: white;
        }
        
        /* Tables */
        .table {
            border-color: var(--morada-accent);
        }
        
        .table thead th {
            background-color: var(--morada-warm);
            color: var(--morada-dark);
            border-color: var(--morada-accent);
        }
        
        .table-hover tbody tr:hover {
            background-color: var(--morada-warm);
        }
        
        /* Forms */
        .form-control:focus {
            border-color: var(--morada-primary);
            box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.25);
        }
        
        .form-select:focus {
            border-color: var(--morada-primary);
            box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.25);
        }
        
        /* Badges */
        .badge.bg-primary {
            background-color: var(--morada-primary) !important;
        }
        
        .badge.bg-success {
            background-color: #28a745 !important;
        }
        
        .badge.bg-warning {
            background-color: var(--morada-accent) !important;
        }
        
        .badge.bg-danger {
            background-color: #dc3545 !important;
        }
        
        .badge.bg-info {
            background-color: #17a2b8 !important;
        }
        
        /* Alerts */
        .alert-primary {
            background-color: var(--morada-warm);
            border-color: var(--morada-primary);
            color: var(--morada-dark);
        }
        
        .alert-success {
            background-color: #d4edda;
            border-color: #28a745;
            color: #155724;
        }
        
        .alert-warning {
            background-color: var(--morada-warm);
            border-color: var(--morada-accent);
            color: var(--morada-dark);
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }
        
        .alert-info {
            background-color: #d1ecf1;
            border-color: #17a2b8;
            color: #0c5460;
        }
        
        /* Sidebar (AdminLTE style) */
        .main-sidebar {
            background-color: var(--morada-dark) !important;
        }
        
        .main-sidebar .nav-link {
            color: var(--morada-light) !important;
        }
        
        .main-sidebar .nav-link:hover,
        .main-sidebar .nav-link.active {
            background-color: var(--morada-primary) !important;
            color: white !important;
        }
        
        /* Content wrapper */
        .content-wrapper {
            background-color: var(--morada-light);
        }
        
        /* Small boxes (stats cards) */
        .small-box {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(139, 69, 19, 0.1);
        }
        
        .small-box.bg-info {
            background-color: var(--morada-primary) !important;
        }
        
        .small-box.bg-success {
            background-color: #28a745 !important;
        }
        
        .small-box.bg-warning {
            background-color: var(--morada-accent) !important;
        }
        
        .small-box.bg-danger {
            background-color: #dc3545 !important;
        }
        
        /* Icons */
        .fas {
            color: var(--morada-primary);
        }
        
        .text-primary {
            color: var(--morada-primary) !important;
        }
        
        .text-secondary {
            color: var(--morada-secondary) !important;
        }
        
        .text-success {
            color: #28a745 !important;
        }
        
        .text-warning {
            color: var(--morada-accent) !important;
        }
        
        .text-danger {
            color: #dc3545 !important;
        }
        
        .text-info {
            color: #17a2b8 !important;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if(auth()->user()->role !== 'Customer')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard.index') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-bed"></i> Hébergement
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('room.index') }}">Chambres</a></li>
                                    <li><a class="dropdown-item" href="{{ route('type.index') }}">Types</a></li>
                                    <li><a class="dropdown-item" href="{{ route('roomstatus.index') }}">Statuts</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('transaction.index') }}">
                                    <i class="fas fa-exchange-alt"></i> Transactions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customer.index') }}">
                                    <i class="fas fa-users"></i> Clients
                                </a>
                            </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login.index') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        <i class="fas fa-id-card"></i> Mon Profil
                                    </a>
                                    
                                    @if(auth()->user()->role === 'Super')
                                    <a class="dropdown-item" href="{{ route('user.index') }}">
                                        <i class="fas fa-user-cog"></i> Utilisateurs
                                    </a>
                                    @endif
                                    
                                    <div class="dropdown-divider"></div>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4">
            <div class="container">
                @include('partials.alerts')
                @yield('content')
            </div>
        </main>
    </div>

    <!-- jQuery (nécessaire pour certains plugins) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS Bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts spécifiques à la page -->
    @stack('scripts')

    <!-- Initialisation Bootstrap -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Vérifier Bootstrap
            if (typeof bootstrap === 'undefined') {
                console.error('⚠️ Bootstrap non chargé, tentative de reload...');
                var script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js';
                script.onload = function() {
                    console.log('✅ Bootstrap rechargé');
                    initBootstrap();
                };
                document.head.appendChild(script);
            } else {
                console.log('✅ Bootstrap chargé');
                initBootstrap();
            }
        });

        function initBootstrap() {
            // Tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Popovers
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });

            // Toasts
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl);
            });

            // Dropdowns (auto-initialisés, mais on force)
            var dropdowns = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            dropdowns.map(function(dropdown) {
                return new bootstrap.Dropdown(dropdown);
            });

            console.log('🚀 Bootstrap initialisé');
        }
    </script>
</body>
</html>