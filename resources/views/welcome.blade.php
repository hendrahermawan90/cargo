<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo Express - Your Trusted Shipping Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }

        .feature-box {
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .feature-box:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 40px;
            color: #0d6efd;
            margin-bottom: 20px;
        }

        .tracking-section {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

        .service-card {
            border: none;
            transition: all 0.3s ease;
        }

        .service-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Your Trusted Shipping Partner</h1>
            <p class="lead mb-4">Fast, reliable, and secure cargo shipping services worldwide</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">Get Started</a>
            <a href="#tracking" class="btn btn-outline-light btn-lg">Track Shipment</a>
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

    <!-- Tracking Section -->
    <section id="tracking" class="tracking-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="mb-4">Track Your Shipment</h2>
                    <div class="card">
                        <div class="card-body">
                            <form class="d-flex">
                                <input type="text" class="form-control form-control-lg me-2"
                                    placeholder="Enter tracking number">
                                <button class="btn btn-primary btn-lg">Track</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                            <p class="card-text">Reliable and cost-effective shipping solution for regular deliveries.
                            </p>
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
                        <li><a href="#tracking" class="text-light">Track Shipment</a></li>
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
</body>

</html>
