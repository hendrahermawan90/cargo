<!DOCTYPE html>
<html>

<head>
    <title>Cargo Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    :root {
        --primary-color: #1abc9c;
        --secondary-color: #16a085;
        --text-light: #f8f9fa;
        --bg-light: #ecf0f1;
        --bg-dark: #2c3e50;
        --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-color: var(--bg-light);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Sidebar Styling */
    .sidebar {
    height: 100vh;
    background: linear-gradient(180deg,rgba(0, 0, 0, 0.71), #2980b9); /* Background gradien kustom */
    padding-top: 20px;
    position: fixed;
    left: 0;
    width: 250px;
    color: var(--text-light); /* Warna teks tetap gelap */
    }

.sidebar .text-center h5 {
    color: #ffffff; /* Pastikan judul Cargo System tetap putih */
    }



    .sidebar .nav-link {
        color: var(--text-light);
        padding: 14px 20px;
        margin: 5px 15px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        background-color: transparent;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background-color: rgba(255, 255, 255, 0.15);
        padding-left: 30px;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
    }

    .main-content {
        margin-left: 250px;
        padding: 20px;
        flex: 1;
    }

    /* Navbar */
    .navbar {
        margin-left: 250px;
        background-color: #ffffff;
        border-bottom: 1px solid #ddd;
        box-shadow: var(--card-shadow);
    }

    .navbar-brand {
        color: var(--secondary-color);
        font-weight: bold;
    }

    .navbar-nav .nav-link {
        color: #555;
    }

    .navbar-nav .nav-link:hover {
        color: var(--primary-color);
    }

    /* Cards */
    .card-dashboard {
        border: none;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        background-color: #fff;
        transition: transform 0.3s ease;
    }

    .card-dashboard:hover {
        transform: translateY(-4px);
    }

    .stat-icon {
        font-size: 2.4rem;
        color: var(--primary-color);
    }

    /* Status Colors */
    .status-delivered {
        color: #27ae60;
    }

    .status-transit {
        color: #f1c40f;
    }

    .status-pending {
        color: #e74c3c;
    }

    /* Footer */
    footer {
        background-color: var(--bg-dark);
        color: var(--text-light);
        padding: 20px 0;
        margin-top: auto;
    }

    footer a {
        color: var(--text-light);
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .sidebar {
            width: 100%;
            position: relative;
            height: auto;
        }

        .main-content,
        .navbar {
            margin-left: 0;
        }
    }

    /* Dark Mode Styles */
body.dark-mode {
    background-color: var(--bg-dark); /* Latar belakang gelap */
    color: var(--text-light); /* Teks terang */
}

/* Dark mode untuk sidebar */
.sidebar.dark-mode {
    background: linear-gradient(180deg, #333, #444); /* Sidebar lebih gelap */
}

/* Dark mode untuk navbar */
.navbar.dark-mode {
    background-color: #333; /* Navbar gelap */
    border-bottom: 1px solid #555; /* Border navbar lebih gelap */
}

/* Dark mode untuk cards */
.card-dashboard.dark-mode {
    background-color: #444; /* Latar belakang kartu gelap */
    color: #fff; /* Teks putih pada kartu */
}

/* Dark mode footer */
footer.dark-mode {
    background-color: #222; /* Footer gelap */
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

    <!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
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
                <!-- Dark Mode Toggle -->
                <li class="nav-item">
                    <button class="btn btn-dark" id="darkModeToggle">
                        <i class="fas fa-moon"></i> Dark Mode
                    </button>
                </li>
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

    <script>
    // Menambahkan event listener untuk tombol Dark Mode
    const darkModeToggle = document.getElementById("darkModeToggle");

    darkModeToggle.addEventListener("click", () => {
        // Toggle class 'dark-mode' pada body
        document.body.classList.toggle("dark-mode");

        // Ganti teks dan icon tombol
        if (document.body.classList.contains("dark-mode")) {
            darkModeToggle.innerHTML = '<i class="fas fa-sun"></i> Light Mode'; // Ganti menjadi Light Mode
        } else {
            darkModeToggle.innerHTML = '<i class="fas fa-moon"></i> Dark Mode'; // Ganti menjadi Dark Mode
        }
    });
</script>
</body>

</html>
