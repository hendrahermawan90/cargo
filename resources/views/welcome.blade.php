<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo Express - Your Trusted Shipping Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>

        /* Import font Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        /* Apply Poppins font globally */
        body, h1, h2, h3, h4, h5, h6, p, a, button, input, textarea {
            font-family: 'Poppins', sans-serif !important;
        }

        .hero-section {
             height: 100vh;
             background-size: cover;
             background-position: center center;
             background-repeat: no-repeat;
             font-family: 'poppins';
             font color: blue;
                display: flex;
             align-items: center;
                justify-content: center;
             text-align: center;
            }   

     
        .customer-service {
            position: fixed;
             bottom: 20px;
                right: 20px;
             z-index: 9999;
            }

        .customer-service .btn {
             display: flex;
             align-items: center;
             justify-content: center;
             font-size: 20px;
             padding: 10px 20px;
              border-radius: 50px;
             box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
             background-color: rgb(0, 64, 255);
             color: #fff;
                text-decoration: none;
             transition: all 0.3s ease;
            }


        .customer-service .btn:hover {
            background-color: #0056b3;
            color: #fff;
            transform: scale(1.1)
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
            color: rgb(0, 64, 255);
            margin-bottom: 20px;
        }

        .tracking-section {
            background-color: rgb(0, 64, 255);
            padding: 80px 0;
        }

        .service-card {
            border: none;
            transition: all 0.3s ease;
        }

        .service-card:hover {
            box-shadow: 0 5px 15px rgb(0, 64, 255);
        }
    </style>
</head>

<body>
   <!-- Navigation -->
   <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="https://cdn-icons-png.flaticon.com/512/2721/2721614.png" alt="Logo" width="50" height="50" class="me-2">
                <span>E-Cargo</span>
            </a>
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

<style>
    .navbar-custom {
        background-color: #0044cc; /* Wairu khusus */
    }

    .navbar-brand span {
        font-family: 'poppins', sans-serif; /* Jenis font untuk brand */
        color: #ffffff; /* Warna font brand */
    }

    .navbar-nav .nav-link {
        font-family: 'Courier New', monospace; /* Jenis font untuk item menu */
        color:rgb(255, 255, 255); /* Warna font untuk item menu */
    }

    .navbar-nav .nav-link:hover {
        color: #ffffff; /* Warna font saat hover */
    }
</style>

   <!-- Customer Service Button -->
   <div class="customer-service">
        <a href="https://wa.me/1234567890" target="_blank" class="btn btn-accent">
            <i class="fab fa-whatsapp me-2"></i> Live Support
        </a>
    </div>

    <!-- filepath: c:\Users\Asus\Documents\GitHub\cargo\resources\views\welcome.blade.php -->
    <style>
    /* Import font Poppins */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* Apply Poppins font globally */
    body {
        font-family: 'Poppins', sans-serif;
    }
        </style>

    <!-- Hero Section with Carousel -->
    <section>
     <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="hero-section d-flex align-items-center justify-content-center" style="background-image: url('https://i.pinimg.com/736x/7e/16/dd/7e16ddcc5d210b8fa9d84821a1e77c66.jpg');">
          <div class="container text-center text-primary">
            <h1 class="display-4 mb-4">Your Trusted Shipping Partner</h1>
            <p class="lead mb-4">Fast, reliable, and secure cargo shipping services worldwide</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">Get Started</a>
            <a href="#tracking" class="btn btn-primary btn-lg me-3">Track Shipment</a>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="hero-section d-flex align-items-center justify-content-center" style="background-image: url('https://i.pinimg.com/736x/17/a1/41/17a1415e4f662715de04ce7b70cd1fc8.jpg');">
          <div class="container text-center text-primary">
            <h1 class="display-4 mb-4">Fast & Secure Shipping</h1>
            <p class="lead mb-4">Professional logistics solutions for your business</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">Get Started</a>
            <a href="#tracking" class="btn btn-primary btn-lg me-3">Track Shipment</a>
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <div class="hero-section d-flex align-items-center justify-content-center" style="background-image: url('https://i.pinimg.com/736x/0d/68/6f/0d686f654ec5355cd6b4eeade2f828f8.jpg');">
          <div class="container text-center text-primary">
            <h1 class="display-4 mb-4">Worldwide Coverage</h1>
            <p class="lead mb-4">Delivering your cargo with care and speed</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">Get Started</a>
            <a href="#tracking" class="btn btn-primary btn-lg me-3">Track Shipment</a>
          </div>
        </div>
      </div>

    </div>
    </div>
    </section>



    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5"  data-aos="fade-right">
                <h2>Why Choose Us</h2>
                <p class="text-muted">We provide the best shipping solutions for your needs</p>
            </div>
            <div class="row">
                <div class="col-md-4"  data-aos="fade-left">
                    <div class="feature-box">
                        <i class="fas fa-shipping-fast feature-icon"></i>
                        <h4>Fast Delivery</h4>
                        <p>Express shipping services to meet your deadlines</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-right">
                    <div class="feature-box">
                        <i class="fas fa-shield-alt feature-icon"></i>
                        <h4>Secure Shipping</h4>
                        <p>Your cargo's safety is our top priority</p>
                    </div>
                </div>
                <div class="col-md-4"  data-aos="fade-left">
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
            <div class="col-md-8" data-aos="fade-zoom-in text-center">
                <h2 class="mb-4" style="text-align: center;">Track Your Shipment</h2>
                <div class="card">
                    <div class="card-body">
                        <form class="d-flex">
                            <input type="text" class="form-control form-control-lg me-2" placeholder="Enter tracking number">
                            <button class="btn btn-primary btn-lg">Track</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    
        
    <!-- Image Section -->
    <div class="image-section mt-3" data-aos="fade-up">
        <img src="https://i.pinimg.com/736x/a7/b1/3e/a7b13e6ccab5015fb3fab7aa6f8f2044.jpg" 
         alt="Cargo Illustration" 
         style="width: 100%; height: 500px;">
    </div>

    <style>
    #tracking {
        margin-bottom: 60px; /* Jarak bawah untuk Tracking Section */
    }

    #tentang-kami {
        margin-top: 60px; /* Jarak atas untuk Tentang Kami */
        margin-bottom: 60px; /* Jarak bawah untuk Tentang Kami */
    }

    .image-section {
        margin-top: 80px; /* Jarak atas untuk Image Section */
        margin-bottom: 60px; /* Jarak bawah untuk Image Section */
    }
    </style>

    <!-- Services Section -->
    <section id="services" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Our Services</h2>
                <p class="text-muted">Comprehensive shipping solutions for all your needs</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4" data-aos="fade-left">
                    <div class="card service-card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-box me-2"></i>Standard Shipping</h5>
                            <p class="card-text">Reliable and cost-effective shipping solution for regular deliveries.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up">
                    <div class="card service-card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-plane me-2"></i>Express Shipping</h5>
                            <p class="card-text">Fast delivery service for time-sensitive shipments.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4"  data-aos="fade-right">
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
    <footer class="bg-dark text-light py-4" data-aos=" fade-up">
        <div class="container">
            <div class="row">
                <div class="col-md-4"  data-aos=" fade-up">
                    <h5>Cargo Express</h5>
                    <p>Your trusted shipping partner for reliable and secure cargo delivery services worldwide.</p>
                </div>
                <div class="col-md-4"  data-aos=" fade-up">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">About Us</a></li>
                        <li><a href="#services" class="text-light">Services</a></li>
                        <li><a href="#tracking" class="text-light">Track Shipment</a></li>
                        <li><a href="#" class="text-light">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4"  data-aos=" fade-up">
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

    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>