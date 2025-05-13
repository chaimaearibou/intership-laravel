<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body >

    <!-- Fixed Navbar -->
    <nav class="navbar navbar-expand-lg nav bg-white">
        <div class="container">
            <!-- Logo + Company Name -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo3.png') }}" alt="Logo" class="logo-img me-2" height="40">
                Company
            </a>

            <!-- Toggler for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link link" href="{{ url('/#about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link link" href="{{ url('/#service') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link link" href="{{ route('offre') }}">Offre</a></li>
                    {{-- <li class="nav-item"><a class="nav-link link" href="{{ route('dasbordAdmin') }}">admin</a></li> --}}
                    <li class="nav-item ms-2">
                        <a href="#" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">
                             Login
                        </a>
                    </li>
                    <li class="nav-item ms-2"><a href="{{ route('show.register') }}" class="btn btn-success">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Spacer to prevent navbar overlap -->
    {{-- <div style="height: 70px;"></div> --}}

    <!-- Main content with flex:1 -->
    <main class="flex-grow-1">
        <div class="container mt-4">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container ">
            <div class="row g-3 ">
                <!-- Company Info -->
                <div class="col-12 col-md-4 ">
                    <h4 class="footer-heading">Company Name</h4>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
    
                <!-- Quick Links -->
                <div class="col-12 col-md-4">
                    <h4 class="footer-heading">Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="footer-link">Home</a></li>
                        <li><a href="{{ url('#about') }}" class="footer-link">About</a></li>
                        <li><a href="{{ url('#service') }}" class="footer-link">Services</a></li>
                        <li><a href="#" class="footer-link">Contact</a></li>
                    </ul>
                </div>
    
                <!-- Contact Info -->
                <div class="col-12 col-md-4">
                    <h4 class="footer-heading">Contact Us</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span class="text-muted">123 Street Name, City</span>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <a href="tel:+1234567890" class="footer-link">+1 (234) 567-890</a>
                        </li>
                        <li>
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:info@example.com" class="footer-link">info@example.com</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
@include('auth.login')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if($errors->any())
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        @endif
    });
</script>


    @stack('scripts')
</body>

</html>
