<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo Express - Your Trusted Shipping Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
            text-align: center;
        }

        .hero-section h1 {
            animation: fadeIn 2s ease-in-out;
        }

        .hero-section p {
            animation: fadeIn 2.5s ease-in-out;
        }

        .hero-section .btn {
            font-size: 18px;
            transition: transform 0.3s ease-in-out;
        }

        .hero-section .btn:hover {
            transform: scale(1.1);
        }

        /* Animasi Fade In */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Feature Box */
        .feature-box {
            padding: 30px;
            text-align: center;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            font-size: 45px;
            color: #0d6efd;
            margin-bottom: 20px;
        }

        /* Services Card */
        .service-card {
            border: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            overflow: hidden;
        }

        .service-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        /* Tracking Section */
        .tracking-section {
            background-color: #f1f3f5;
            padding: 80px 0;
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: white;
        }

        footer a {
            color: #d6d6d6;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #0d6efd;
        }

        /* Media Query untuk responsif */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }

            .hero-section p {
                font-size: 1.2rem;
            }
        }

        body.dark-mode {
            background-color: #121212;
            color: #f1f1f1;
        }

        body.dark-mode .navbar {
            background-color: #1f1f1f !important;
            color: #ffffff;
        }

        body.dark-mode .nav-link,
        body.dark-mode .navbar-brand {
            color: #ffffff !important;
        }

        body.dark-mode .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
                url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            color: #ffffff;
        }

        body.dark-mode .feature-box {
            background-color: #1e1e1e;
            border-radius: 10px;
        }

        body.dark-mode .feature-icon {
            color: #0d6efd;
        }

        body.dark-mode .tracking-section {
            background-color: #1a1a1a;
        }

        body.dark-mode .card {
            background-color: #2a2a2a;
            color: #ffffff;
        }

        body.dark-mode .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        body.dark-mode .btn-outline-light {
            color: #ffffff;
            border-color: #ffffff;
        }

        body.dark-mode .service-card {
            background-color: #1f1f1f;
            color: #ffffff;
            border: 1px solid #333;
        }

        body.dark-mode footer {
            background-color: #1f1f1f;
            color: #f1f1f1;
        }

        body.dark-mode footer a {
            color: #f1f1f1;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Cargo Express</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    @if (Route::has('login'))
                        @auth
                            @if(Auth::user()->role === 'customer')
                                <li class="nav-item">
                                    <a href="#tracking" class="nav-link">Riwayat Pengiriman</a>
                                </li>
                            @else
                                <li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a></li>
                            @endif
                        @else
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                            @if (Route::has('register'))
                                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                            @endif
                        @endauth
                    @endif
                </ul>

                <!-- Dark mode switch -->
                <div class="form-check form-switch ms-3">
                    <input class="form-check-input" type="checkbox" id="darkModeSwitch">
                    <label class="form-check-label" for="darkModeSwitch">Dark Mode</label>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 mb-4">Your Trusted Shipping Partner</h1>
            <p class="lead mb-4">Fast, reliable, and secure cargo shipping services worldwide</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">Get Started</a>
            <a href="#tracking" class="btn btn-outline-light btn-lg">Track Your Shipments</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Why Choose Us</h2>
                <p class="text-muted">We provide the best shipping solutions for your needs</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-shipping-fast feature-icon"></i>
                        <h4>Fast Delivery</h4>
                        <p>Express shipping services to meet your deadlines</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-shield-alt feature-icon"></i>
                        <h4>Secure Shipping</h4>
                        <p>Your cargo's safety is our top priority</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-globe feature-icon"></i>
                        <h4>Global Coverage</h4>
                        <p>Shipping services available worldwide</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tracking Section (Form Pelacakan Resi) -->
    <section id="tracking" class="tracking-section">
        <div class="container">
            <div class="text-center mb-4">
                <h2>Lacak Pengiriman Anda</h2>
                <p class="text-muted">Masukkan nomor resi untuk melihat riwayat pengiriman barang</p>

                <form method="POST" action="{{ url('/') }}" class="d-flex justify-content-center mt-4">
                    @csrf
                    <input type="text" name="tracking_number" class="form-control w-50 me-2" placeholder="Masukkan nomor resi" required>
                    <button class="btn btn-primary" type="submit">Lacak</button>
                </form>
            </div>

            @if(isset($shipment))
                <div class="card mx-auto" style="max-width: 700px;">
                    <div class="card-header bg-light">
                        <strong>Resi:</strong> {{ $shipment->tracking_number }}
                        <span class="badge bg-primary float-end">{{ ucfirst($shipment->status) }}</span>
                    </div>
                    <div class="card-body">
                        @if($shipment->trackings->count())
                            <ul class="list-group">
                                @foreach($shipment->trackings as $log)
                                    <li class="list-group-item">
                                        {{ \Carbon\Carbon::parse($log->CreatedDate)->format('d-m-Y H:i') }}
                                        - {{ $log->status }} @if($log->location) di {{ $log->location }} @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Belum ada riwayat pengiriman.</p>
                        @endif
                    </div>
                </div>
            @elseif(session('not_found'))
                <div class="alert alert-warning text-center mt-4">
                    Nomor resi tidak ditemukan.
                </div>
            @endif
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Our Services</h2>
                <p class="text-muted">Comprehensive shipping solutions for all your needs</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card service-card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-box me-2"></i>Standard Shipping</h5>
                            <p class="card-text">Reliable and cost-effective shipping solution for regular deliveries.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-plane me-2"></i>Express Shipping</h5>
                            <p class="card-text">Fast delivery service for time-sensitive shipments.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-warehouse me-2"></i>Warehousing</h5>
                            <p class="card-text">Secure storage solutions for your cargo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Cargo Express</h5>
                    <p>Your trusted shipping partner for reliable and secure cargo delivery services worldwide.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">About Us</a></li>
                        <li><a href="#services" class="text-light">Services</a></li>
                        <li><a href="#tracking" class="text-light">Shipment History</a></li>
                        <li><a href="#" class="text-light">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i> +1 234 567 890</li>
                        <li><i class="fas fa-envelope me-2"></i> info@cargoexpress.com</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> 123 Shipping Street, City</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 Cargo Express. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const toggleSwitch = document.getElementById('darkModeSwitch');
        toggleSwitch.addEventListener('change', function () {
            document.body.classList.toggle('dark-mode', this.checked);
            localStorage.setItem('darkModeEnabled', this.checked);
        });

        window.addEventListener('DOMContentLoaded', () => {
            const enabled = JSON.parse(localStorage.getItem('darkModeEnabled'));
            if (enabled) {
                document.body.classList.add('dark-mode');
                toggleSwitch.checked = true;
            }
        });
    </script>
</body>

</html>
