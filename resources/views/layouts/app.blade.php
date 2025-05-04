<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Gestion de stagaire-{{ config('app.name', 'Gestion de Stage') }}</title>
</head>
<body>
   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg nav" style="background-color:white;">
    <div class="container-fluid">
        <img src="{{ asset('images/logo3.png') }}" alt="Logo" width="50" class="logo-img">
      <a class="navbar-brand company-name " href="#">Company</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></i></span>
     </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
          <li class="nav-item">
            <a class="nav-link link" href="{{ route('contact') }}">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link" href="{{ route('dasbordAdmin') }}">admin</a>
          </li>
        </ul>
        <form class="d-flex" >
            <button class="btn btn-success  me-2" type="button">Login</button>
            <button class="btn btn-outline-success  me-2" type="button">Register</button>
            
        </form>
      </div>
    </div>
  </nav>
    <!-- Navbar end -->
     <!--Main section -->
  <main class="container-fluid mt-5">
    @yield('content')
  </main>
  
  <!-- Footer -->

   <footer class="footer">
    <div class="container">
        <div class="row g-4">
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
<!-- ========== END FOOTER ========== -->

 @stack('scripts')
    

</body>
</html>