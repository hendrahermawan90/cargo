<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cargo Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Sidebar Styling */
        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, #2c3e50, #34495e);
            position: fixed;
            left: 0;
            width: 250px;
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
        <a class="nav-link {{ request()->is('tracking*') ? 'active' : '' }}" href="#">
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
        <a class="nav-link {{ request()->is('reports*') ? 'active' : '' }}" href="#">
            <i class="fas fa-file-invoice"></i> Reports
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('settings*') ? 'active' : '' }}" href="#">
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

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card card-dashboard p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Total Shipments</h6>
                            <h2>1,234</h2>
                        </div>
                        <i class="fas fa-box stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-dashboard p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>In Transit</h6>
                            <h2>256</h2>
                        </div>
                        <i class="fas fa-truck stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-dashboard p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Delivered</h6>
                            <h2>890</h2>
                        </div>
                        <i class="fas fa-check-circle stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-dashboard p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Revenue</h6>
                            <h2>$45.5k</h2>
                        </div>
                        <i class="fas fa-dollar-sign stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card card-dashboard p-4">
            <div class="card-header bg-white">
                <h5>Recent Shipments</h5>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Tracking ID</th>
                                <th>Customer</th>
                                <th>Destination</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#TRK-123456</td>
                                <td>John Doe</td>
                                <td>New York, USA</td>
                                <td>2024-02-20</td>
                                <td><span class="badge status-delivered">Delivered</span></td>
                                <td><button class="btn btn-sm btn-outline-primary">Details</button></td>
                            </tr>
                            <tr>
                                <td>#TRK-123457</td>
                                <td>Jane Smith</td>
                                <td>London, UK</td>
                                <td>2024-02-19</td>
                                <td><span class="badge status-transit">In Transit</span></td>
                                <td><button class="btn btn-sm btn-outline-primary">Details</button></td>
                            </tr>
                            <tr>
                                <td>#TRK-123458</td>
                                <td>Robert Johnson</td>
                                <td>Tokyo, Japan</td>
                                <td>2024-02-18</td>
                                <td><span class="badge status-pending">Pending</span></td>
                                <td><button class="btn btn-sm btn-outline-primary">Details</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; 2024 Cargo Express. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
