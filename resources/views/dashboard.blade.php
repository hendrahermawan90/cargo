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

        /* Main Content Styling */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
        }

        /* Navbar Styling */
        .navbar {
            margin-left: 250px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
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

        .stat-icon {
            font-size: 2.5rem;
            color: #3498db;
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
            margin-top: auto;
        }

        footer a {
            color: #ecf0f1;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Ensure flexbox layout */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }

        /* Responsive adjustments */
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
                <a class="nav-link" href="#"><i class="fas fa-users"></i> Customers</a>
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

    <!-- Navbar -->
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

    <!-- Main Content -->
    <div class="main-content">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card card-dashboard">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-muted">Total Shipments</h6>
                                <h2 class="card-title mb-0">1,234</h2>
                            </div>
                            <i class="fas fa-box stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-dashboard">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-muted">In Transit</h6>
                                <h2 class="card-title mb-0">256</h2>
                            </div>
                            <i class="fas fa-truck stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-dashboard">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-muted">Delivered</h6>
                                <h2 class="card-title mb-0">890</h2>
                            </div>
                            <i class="fas fa-check-circle stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-dashboard">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-muted">Revenue</h6>
                                <h2 class="card-title mb-0">$45.5k</h2>
                            </div>
                            <i class="fas fa-dollar-sign stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Shipments -->
        <div class="card card-dashboard mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Shipments</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table tracking-table">
                        <thead>
                            <tr>
                                <th>Tracking ID</th>
                                <th>Customer</th>
                                <th>Destination</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#TRK-123456</td>
                                <td>John Doe</td>
                                <td>New York, USA</td>
                                <td>2024-02-20</td>
                                <td><span class="status-delivered"><i class="fas fa-check-circle"></i> Delivered</span>
                                </td>
                                <td><button class="btn btn-sm btn-primary">Details</button></td>
                            </tr>
                            <tr>
                                <td>#TRK-123457</td>
                                <td>Jane Smith</td>
                                <td>London, UK</td>
                                <td>2024-02-19</td>
                                <td><span class="status-transit"><i class="fas fa-truck"></i> In Transit</span></td>
                                <td><button class="btn btn-sm btn-primary">Details</button></td>
                            </tr>
                            <tr>
                                <td>#TRK-123458</td>
                                <td>Robert Johnson</td>
                                <td>Tokyo, Japan</td>
                                <td>2024-02-18</td>
                                <td><span class="status-pending"><i class="fas fa-clock"></i> Pending</span></td>
                                <td><button class="btn btn-sm btn-primary">Details</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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

</html>
