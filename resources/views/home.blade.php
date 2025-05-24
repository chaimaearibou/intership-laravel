@extends('layouts.app')

@section('content')
    <!-- home  Section -->
    <section class="hero-section" id="home">
        <div class="container-fluid min-vh-100 d-flex align-items-center">
            <div class="row w-100 g-5 align-items-center justify-content-center">
                <!-- Text Content -->
                <div class="col-lg-6 text-center text-lg-start">
                    <div class="hero-content">
                        <h1 class="display-3 fw-bold mb-4 text-dark">
                            Find Your Perfect<br>
                            <span class="text-gradient">Internship Today!</span>
                        </h1>
                        <p class="lead mb-4">
                            Discover top offers tailored for students and interns.
                        </p>
                        <a href="{{ route('offre') }}" class="btn btn-apply-now btn-lg px-5 py-3">
                            Apply Now <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Image Section -->
                <div class="col-lg-6">
                    <div class="hero-image-container">
                        <img src="{{ asset('images/hero4.png') }}" alt="Internship Illustration" class="hero-main-image">
                        <div class="blur-circle"></div>
                        <div class="big-shape"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- about us  Section -->
    <section class="about-section" id="about">
        {{-- <div class="decorative-circle"></div> --}}

        <div class="container">
            <!-- Section Titre + Description -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <h2 class="about-title">About Us</h2>
                    <div class="about-card">
                        <p class="about-content">
                            Born from the need to simplify internship discovery, we've created a trusted bridge between
                            students and innovative companies. Every opportunity on our platform undergoes strict
                            verification to ensure quality and relevance.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section Mission en ligne -->
            <div class="row justify-content-center g-4">
                <div class="col-lg-5">
                    <div class="about-card h-100">
                        <i class="fa-sharp fa-solid fa-bullseye fa-rotate-180 fa-lg"></i>
                        <h3 class="mb-4">Our Mission</h3>
                        <p class="mission-statement">
                            Bridge the gap between academic excellence and professional success through
                            transformative internship opportunities.
                        </p>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="about-card h-100">
                        <i class="fas fa-chart-line about-icon"></i>
                        <h3 class="mb-4">Our Values</h3>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="value-item">
                                    <i class="fas fa-users fa-lg mb-2 text-primary"></i>
                                    <h5>Student Focus</h5>
                                    <p class="small mb-0">Smart matching algorithm</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="value-item">
                                    <i class="fas fa-building fa-lg mb-2 text-primary"></i>
                                    <h5>Quality Partners</h5>
                                    <p class="small mb-0">500+ verified companies</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- service Section -->
    <section class="services-section py-5" id="service">
        <div class="container">
            <h2 class="section-title mb-5" style="text-align: center !important;">Our Services</h2>

            <div class="row g-4 justify-content-center">
                <!-- Card 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="card-icon">
                            <i class="fas fa-briefcase fa-3x"></i>
                        </div>
                        <h3 class="card-heading">Curated Internships</h3>
                        <p class="card-description">
                            Explore verified opportunities across tech, marketing, and design.
                            Updated daily with new positions from trusted companies.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="card-icon">
                            <i class="fas fa-user-tie fa-3x"></i>
                        </div>
                        <h3 class="card-heading">Smart Profile</h3>
                        <p class="card-description">
                            Build your professional identity with our AI-enhanced profile builder.
                            Track applications and get personalized recommendations.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="card-icon">
                            <i class="fas fa-bell fa-3x"></i>
                        </div>
                        <h3 class="card-heading">Live Updates</h3>
                        <p class="card-description">
                            Instant notifications for new matches and application status.
                            Never miss deadlines with our smart reminder system.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('offre') }}" class="btn btn-primary-cta">
                    Discover Opportunities
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        {{-- * back to top of the page button  --}}
        <a href="#" class="back-to-top" id="backToTop">
            <i class="fas fa-arrow-up"></i>
        </a>
    </section>
    @push('scripts')
        <script>
            // fonction qui afficher le button de back to top 
            const backToTopBtn = document.getElementById('backToTop');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 420) {
                    backToTopBtn.style.display = 'block';
                } else {
                    backToTopBtn.style.display = 'none';
                }
            });

            backToTopBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        </script>
    @endpush
@endsection
