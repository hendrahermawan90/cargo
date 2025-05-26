<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cargo Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Tambahkan di bagian <head> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Tambahkan sebelum </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Sidebar Styling */
        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, #2c3e50, #34495e);
            position: fixed;
            left: 0;
            width: 230px;
            color: #ecf0f1;
            padding-top: 20px;

        }

        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 15px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #1abc9c;
            color: #fff;
            transform: scale(1.05);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
            background: #f4f6f9;
            min-height: 100vh;
        }

        .navbar {
            margin-left: 250px;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .card-dashboard {
            border: none;
            border-radius: 12px;
            background: linear-gradient(145deg, #ffffff, #e6e6e6);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .card-dashboard:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5rem;
            color: #3498db;
        }

        .table .badge {
            font-size: 0.85rem;
            padding: 5px 10px;
        }

        .status-delivered {
            background-color: #2ecc71;
        }

        .status-transit {
            background-color: #f1c40f;
        }

        .status-pending {
            background-color: #e74c3c;
        }

        footer {
            background-color: #2c3e50;
            color: #bdc3c7;
            padding: 20px 0;
            margin-top: 40px;
        }

        footer a {
            color: #bdc3c7;
        }

        footer a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        @media (max-width: 767px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content,
            .navbar {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
<!-- Sidebar -->
<div class="sidebar">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="width: 100px;">
            <h5 class="mt-2">Cargo Express</h5>
        </div>
    <ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
            <i class="fas fa-home"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('shipments*') ? 'active' : '' }}" href="/shipments">
            <i class="fas fa-box"></i> Shipments
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('tracking*') ? 'active' : '' }}" href="/tracking">
            <i class="fas fa-truck"></i> Tracking
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('customers*') ? 'active' : '' }}" href="/customers">
            <i class="fas fa-users"></i> Customers
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('orders*') ? 'active' : '' }}" href="/orders">
            <i class="fas fa-file-alt"></i> Orders
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('vendors*') ? 'active' : '' }}" href="/vendors">
            <i class="fas fa-store"></i> Vendors
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('reports*') ? 'active' : '' }}" href="/reports">
            <i class="fas fa-file-invoice"></i> Reports
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('settings*') ? 'active' : '' }}" href="/settings">
            <i class="fas fa-cog"></i> Settings
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </li>
    </ul>

</div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Cargo Express</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="main-content">
        @yield('content')

                @if (session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: '{{ session('success') }}',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        });
                    </script>
                 @endif

                 @if (session('error'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: '{{ session('error') }}',
                            });
                        });
                    </script>
                @endif


    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 Cargo Express. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<!-- tesss -->

</html>
