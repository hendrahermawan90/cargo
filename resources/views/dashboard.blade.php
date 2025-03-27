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
            background: linear-gradient(180deg, #1B263B, #415A77);
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
            background-color:rgb(224, 226, 227);
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
            background: linear-gradient(180deg, #E3F2FD, #BBDEFB);
        }

        /* Navbar Styling */
        .navbar {
            margin-left: 250px;
            background: #E3F2FD;
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
            background: linear-gradient(180deg, #4A148C, #7B1FA2);
    c       olor: #fff;
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
            <img src="data:image/jpeg;base64,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" alt="Logo" class="rounded-circle" style="width: 100px;">
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
