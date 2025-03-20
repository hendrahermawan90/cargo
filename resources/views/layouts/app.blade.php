<!DOCTYPE html>
<html>

<head>
    <title>Cargo Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Sidebar Styling */
        .sidebar {
            height: 100vh;
            background-color: #2c3e50;
            padding-top: 20px;
            position: fixed;
            left: 0;
            width: 250px;
        }

        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 15px 20px;
            margin: 5px 0;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease, padding-left 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #34495e;
            padding-left: 30px;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .navbar {
            margin-left: 250px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }

        /* Hero Section Styling */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero-section .btn {
            font-size: 1.1rem;
            padding: 10px 30px;
            margin-top: 20px;
        }

        /* Card Styling */
        .card-dashboard {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card-dashboard:hover {
            transform: translateY(-5px);
        }

        /* Status Styling */
        .status-delivered {
            color: #27ae60;
        }

        .status-transit {
            color: #f39c12;
        }

        .status-pending {
            color: #e74c3c;
        }

        /* Footer Styling */
        footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
        }

        footer a {
            color: #ecf0f1;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Table Styling */
        .tracking-table th,
        .tracking-table td {
            padding: 12px 15px;
        }

        /* Custom Button Hover */
        .btn-custom {
            background-color: #3498db;
            color: #fff;
            border-radius: 50px;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #2980b9;
        }

        /* Adjust for smaller screens */
        @media (max-width: 767px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }

            .navbar {
                margin-left: 0;
            }
        }

        /* Body styling to ensure the footer stays at the bottom */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Ensure body takes at least 100% of the viewport height */
    }

    /* Main content should take available space */
    .main-content {
        flex: 1; /* This ensures main content grows to fill available space */
    }

    /* Footer styling */
    footer {
        background-color:rgb(42, 46, 49);
        color: #ecf0f1;
        padding: 20px;
        margin-top: auto; /* Push the footer to the bottom */
    }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="" style="width: 100px;">
            <h5 class="text-white mt-3">Cargo System</h5>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="/dashboard"><i class="fas fa-home"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/shipments"><i class="fas fa-box"></i> Shipments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-truck"></i> Tracking</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/customers"><i class="fas fa-users"></i> Customers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/orders"><i class="fas fa-users"></i> Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/vendors"><i class="fas fa-truck"></i> Vendors</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-file-invoice"></i> Reports</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-cog"></i> Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Cargo Express</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tracking">Track Shipment</a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 Cargo Express. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<!-- tesss -->

</html>
