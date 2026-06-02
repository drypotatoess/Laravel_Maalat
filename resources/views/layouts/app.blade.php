<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedPatient - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --teal: #2aacbb;
            --teal-dark: #1d8a97;
            --teal-light: #e8f7f9;
            --sidebar-bg: #1a3c40;
        }

        body {
            background-color: #f0f7f8;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform .3s ease;
        }

        .sidebar-brand {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #ffffff18;
        }

        .sidebar-brand h5 {
            color: #fff;
            margin: 0;
            font-weight: 700;
            font-size: 17px;
        }

        .sidebar-brand h5 i {
            color: var(--teal);
        }

        .sidebar-brand p {
            color: #a0b8bb;
            margin: 0;
            font-size: 11px;
        }

        .sidebar-nav {
            flex: 1;
            padding: .75rem;
        }

        .nav-label {
            font-size: 10px;
            color: #6a9ea3;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: .5rem .75rem .25rem;
            font-weight: 600;
        }

        .sidebar .nav-link {
            color: #b0cdd0;
            border-radius: 8px;
            padding: .55rem .75rem;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2px;
            transition: all .2s;
        }

        .sidebar .nav-link:hover {
            background: #2aacbb22;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: var(--teal);
            color: #fff;
        }

        .sidebar-footer {
            padding: .75rem;
            border-top: 1px solid #ffffff18;
        }

        .main-content {
            margin-left: 240px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left .3s ease;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #d8eef0;
            padding: .75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .topbar .search-box input {
            max-width: 300px;
            border-radius: 8px;
            border: 1px solid #d8eef0;
            background: #f0f7f8;
            font-size: 13px;
            padding: .4rem .75rem .4rem 2rem;
        }

        .topbar .search-box input:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: none;
        }

        .page-content {
            padding: 1.5rem;
            flex: 1;
        }

        .stat-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #d8eef0;
            padding: 1.25rem;
        }

        .stat-card .stat-value {
            font-size: 30px;
            font-weight: 700;
            color: #1a3c40;
        }

        .stat-card .stat-label {
            font-size: 12px;
            color: #6a9ea3;
        }

        .stat-card .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .card {
            border-radius: 14px;
            border: 1px solid #d8eef0;
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #d8eef0;
            border-radius: 14px 14px 0 0 !important;
            padding: 1rem 1.25rem;
        }

        .table th {
            font-size: 11px;
            text-transform: uppercase;
            color: #6a9ea3;
            font-weight: 600;
            border-bottom: 1px solid #d8eef0;
        }

        .table td {
            font-size: 13px;
            vertical-align: middle;
        }

        .btn-primary {
            background: var(--teal);
            border-color: var(--teal);
        }

        .btn-primary:hover {
            background: var(--teal-dark);
            border-color: var(--teal-dark);
        }

        .toast-container {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 9999;
        }

        .logout-btn {
            color: #ff6b6b !important;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }

        .logout-btn:hover {
            background: #ff6b6b22 !important;
        }

        
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            z-index: 1039;
        }

        .sidebar-overlay.show {
            display: block;
        }

        
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: #1a3c40;
            padding: 0;
            line-height: 1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: flex;
                align-items: center;
            }

            .topbar .search-box input {
                max-width: 160px;
            }
        }
    </style>
</head>

<body>

    <!-- Overlay  -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h5><i class="bi bi-heart-pulse-fill"></i> MedPatient</h5>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Users Management
            </a>
            <a href="{{ route('patients.index') }}" class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}">
                <i class="bi bi-clipboard2-heart-fill"></i> Patient Records
            </a>
        </nav>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link logout-btn">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar">
    
            <button class="sidebar-toggle me-2" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <div class="search-box flex-grow-1">
                <div class="position-relative">
                    <i class="bi bi-search position-absolute" style="left:8px;top:50%;transform:translateY(-50%);color:#6a9ea3;font-size:13px"></i>
                    <input type="text" class="form-control" placeholder="Search..." style="padding-left:28px">
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-light btn-sm rounded-circle" style="width:36px;height:36px;border:1px solid #d8eef0">
                    <i class="bi bi-bell" style="color:#6a9ea3"></i>
                </button>
                <a href="{{ route('profile.edit') }}" title="My Profile">
                    @if(auth()->user()->profile_picture)
                    <img src="{{ asset('images/profiles/' . auth()->user()->profile_picture) }}"
                        style="width:36px;height:36px;border-radius:50%;object-fit:cover;border:2px solid #2aacbb">
                    @else
                    <img src="{{ asset('images/default-avatar.png') }}"
                        style="width:36px;height:36px;border-radius:50%;object-fit:cover;border:2px solid #2aacbb">
                    @endif
                </a>
            </div>
        </div>
        <div class="page-content">
            @yield('content')
        </div>
    </div>

    <div class="toast-container">
        @if(session('success'))
        <div class="toast align-items-center text-white border-0 show" role="alert" style="background:var(--teal)">
            <div class="d-flex">
                <div class="toast-body"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="toast align-items-center text-white bg-danger border-0 show" role="alert">
            <div class="d-flex">
                <div class="toast-body"><i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle = document.getElementById('sidebarToggle');

        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });

      
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
            });
        });

        // Toast 
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toast').forEach(t => setTimeout(() => t.classList.remove('show'), 3000));
        });
    </script>
    @stack('scripts')
</body>

</html>