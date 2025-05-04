<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
        }
        body {
            background-color: #f8f9fa;
        }
        .admin-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .admin-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem 0;
        }
        .admin-sidebar {
            background-color: var(--secondary-color);
            min-height: calc(100vh - 60px);
            color: white;
        }
        .admin-content {
            padding: 2rem;
        }
        .nav-link {
            color: rgba(255,255,255,0.8);
            transition: all 0.3s;
        }
        .nav-link:hover {
            color: white;
            background-color: rgba(255,255,255,0.1);
        }
        .nav-link.active {
            color: white;
            background-color: var(--accent-color);
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Admin Panel</h4>
                    <div class="d-flex align-items-center">
                        <span class="me-3">{{ session('admin_name') }}</span>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">
                                <i class="fas fa-sign-out-alt"></i> Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-md-block admin-sidebar">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                                   href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.equipment.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.equipment.index') }}">
                                    <i class="fas fa-tools me-2"></i> Quản lý thiết bị
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.staff.index') }}">
                                    <i class="fas fa-users me-2"></i> Quản lý nhân viên
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.statistics.index') }}">
                                    <i class="fas fa-chart-bar me-2"></i> Thống kê
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-10 admin-content">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 