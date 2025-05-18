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
    <title>Gestion de stagaire</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body >

    <!-- Fixed Navbar -->
    <nav class="navbar navbar-expand-lg nav bg-white" style="background-color:white;">
        <div class="container-fluid">
            <!-- Logo + Company Name -->
                <img src="{{ asset('images/logo3.png') }}" alt="Logo" class="logo-img me-2" height="40">
                <a class="navbar-brand company-name " href="#">Company</a>
            <!-- Toggler for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link  link" aria-current="page" href="{{route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link"  href="{{url('/#about')}}">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link" href="{{url('/#service')}}">service</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link" href="{{ route('offre') }}">Offres</a>
          </li>

        </ul>
<!--  Auth Section in Navbar -->
    @auth
    <li class="nav-item dropdown ms-3">
        <a class="nav-link dropdown-toggle d-flex align-items-center py-1" href="#" 
        id="userDropdown" role="button" data-bs-toggle="dropdown" 
        aria-expanded="false" style="min-height: 50px;">
            
            <!-- User Avatar with Fallback -->
            <div class="position-relative me-2">
                 @php
                $profile = Auth::user()->candidat_profile;
            @endphp

            @if($profile && $profile->photo)
                @php
                    // Check if the photo is a URL (fake API) or a stored photo
                    $isExternal = Str::startsWith($profile->photo, ['http://', 'https://']);
                    $photoUrl = $isExternal ? $profile->photo : asset('storage/profile_photos/' . $profile->photo);
                @endphp

                <img src="{{ $photoUrl }}" 
                    class="rounded-circle border border-2 border-primary profile-avatar"
                    width="38px" 
                    height="38px" 
                    style="object-fit: cover; object-position: center;">
            @else
                <div class="avatar-placeholder bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 38px; height: 38px;">
                    {{ strtoupper(substr(Auth::user()->prenom, 0, 1)) }}{{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
                </div>
            @endif
            </div>
            <!-- User Info -->
            <div class="d-none d-lg-block">
                <div class="fw-semibold small">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</div>
            </div>
        </a>
        
        <!-- Dropdown Menu -->
        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
            <!-- Header -->
            <li class="dropdown-header px-3 py-2">
                <div class="fw-semibold">Account</div>
                <div class="text-truncate small text-muted">{{ Auth::user()->email }}</div>
            </li>
            <li><hr class="dropdown-divider mx-2"></li>
            
            <!-- Navigation Links -->
            @if(Auth::user()->role === 'interne')
            <li>
                <a class="dropdown-item d-flex align-items-center px-3 py-2" 
                href="{{ route('dashboard.user') }}">
                    <i class="fas fa-home fa-fw me-2 text-primary"></i>
                    Dashboard
                </a>
            </li>
            @endif
            
            <li>
                <a class="dropdown-item d-flex align-items-center px-3 py-2" 
                href="">
                    <i class="fas fa-user-cog fa-fw me-2 text-success"></i>
                    Profile Settings
                </a>
            </li>
            
            <li><hr class="dropdown-divider mx-2"></li>
            
            <!-- Logout -->
            <li>
                <form method="POST" action="{{ route('logout') }}" class="dropdown-item p-0">
                    @csrf
                    <button type="submit" 
                            class="btn btn-link text-decoration-none text-danger w-100 text-start px-3 py-2">
                        <i class="fas fa-sign-out-alt fa-fw me-2"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </li>
    @else
    <!-- Guest Links -->
            <li class="nav-item ms-2">
                <a href="#" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Login
                </a>
            </li>
            <li class="nav-item ms-2">
                <a href="{{ route('show.register') }}" class="btn btn-success">
                    Register
                </a>
            </li>
            @endauth
            </div>
        </div>
    </nav>
    <!-- Main content with flex:1 -->
    <main class="flex-grow-1">
        <div class="container mt-4">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
   <footer class="footer">
    <div class="container">
        <div class="row g-4 p-3">
            <!-- Company Info -->
            <div class="col-md-4 text-center text-md-start">
                <a href="#" class="d-inline-block mb-3">
                    <img src="{{asset('images/logo3.png') }}" alt="Logo" width="60" class="footer-brand">
                </a>
                <p class="text-muted mb-2"><i>"Your trusted partner in finding internships that launch careers"</i></p>
                <div class="d-flex gap-3 justify-content-center justify-content-md-start">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 text-center">
                <h5 class="footer-heading">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="footer-link">About Us</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Service</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Internships</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Contact</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4 text-center text-md-end">
                <h5 class="footer-heading">Contact Us</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="aribouchaimae021@gmail.com" class="footer-link">info@company.com</a></li>
                    <li class="mb-2"><a href="tel:+1234567890" class="footer-link">+1 (234) 567-890</a></li>
                    <li class="mb-2">123 Education Street</li>
                    <li>Knowledge City, LN 12345</li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <p class="text-muted small mb-0">&copy; 2025 Company Name. All rights reserved.</p>
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
