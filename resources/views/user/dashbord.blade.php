@extends('layouts.user')
@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 70px">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Floating Home Button -->
        <a href="{{ route('home') }}" class="floating-home-btn d-flex">
            <i class="bi bi-house-door justify-center align-content-center"></i>
        </a>
        <!-- Header Section -->
        <header class="dashboard-header">
            <div class="header-content">
                <h1 class="welcome-title">Welcome, {{ Auth::user()->prenom }} <span class="waving-hand">👋</span></h1>
                <p class="activity-status">Your real-time activity overview</p>
            </div>
            {{-- ! notification part  --}}
            @php
                $notifications = $notifications ?? collect();
                $unreadNotifications = $unreadNotifications ?? 0;
            @endphp

            <div class="notification-container position-relative dropdown">
                <a class="notification-bell position-relative dropdown-toggle" href="#" role="button"
                    id="dropdownNotif" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications">
                    <i class="bi bi-bell-fill fs-4 text-white"></i>
                    @if ($unreadNotifications > 0)
                        <span
                            class="notification-counter position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger pulse">
                            {{ $unreadNotifications }}
                            <span class="visually-hidden">Notifications non lues</span>
                        </span>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="dropdownNotif"
                    style="min-width: 320px; max-height: 60vh; overflow-y: auto;">
                    @forelse($notifications as $notif)
                        <li class="notification-item {{ !$notif->lue ? 'unread' : '' }}">
                            <form action="{{ route('notifications.read', $notif->notification_id) }}" method="POST"
                                class="d-flex">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="dropdown-item d-flex align-items-center w-100 py-3 small"
                                    aria-label="Marquer comme lu">
                                    @if (!$notif->lue)
                                        <span class="unread-indicator me-2 bg-primary"></span>
                                    @endif
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="{{ $notif->lue ? 'text-muted' : 'fw-semibold' }}">
                                                {{ $notif->message }}
                                            </span>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        </li>
                    @empty
                        <li class="dropdown-item text-muted text-center py-3">Aucune notification</li>
                    @endforelse
                </ul>
            </div>




        </header>

        <!-- Metrics Grid -->
        <div class="metrics-grid">
            <!-- Applications Card -->
            <div class="metric-card applications">
                <div class="metric-header">
                    <i class="bi bi-send-check-fill metric-icon"></i>
                    <h3>Applications</h3>
                </div>
                <div class="metric-content">
                    <div class="main-metric">
                        <span class="metric-value">{{ $applicationsCount }}</span>
                        <span class="metric-label">Total Submitted</span>
                    </div>
                    <div class="progress-tracker">
                        <div class="progress-fill" style="width: {{ ($applicationsCount / 10) * 100 }}%"></div>
                    </div>
                </div>
                <a href="" class="metric-action">
                    View Details <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>

            <!-- Views Card -->
            <div class="metric-card views">
                <div class="metric-header">
                    <i class="bi bi-eye-fill metric-icon"></i>
                    <h3>Opportunity Views</h3>
                </div>
                <div class="metric-content">
                    <div class="main-metric">
                        <span class="metric-value">{{ $offersViewed }}</span>
                        <span class="metric-label">Jobs Viewed</span>
                    </div>
                    <div class="trend-indicator">
                        <i class="bi bi-graph-up"></i>
                        +15% vs Last Month
                    </div>
                </div>
                <a href="{{ route('offre') }}" class="metric-action">
                    Explore <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>

        <!-- Quick Actions -->
        <section class="quick-actions">
            <h2 class="section-heading">Quick Access</h2>
            <div class="actions-grid">
                <a href="{{ route('offre') }}" class="action-card search">
                    <i class="bi bi-search-heart action-icon"></i>
                    <h4>Advanced Search</h4>
                    <p>Find personalized opportunities</p>
                </a>

                <a href="" class="action-card cv">
                    <i class="bi bi-file-earmark-richtext action-icon"></i>
                    <h4>My CV</h4>
                    <p>Profile Completeness: 75%</p>
                </a>
            </div>
        </section>

        <!-- Recent Applications -->
        @if ($applications->count() > 0)
            <section class="recent-applications">
                <h2 class="section-heading">Recent Applications</h2>
                <div class="applications-list">
                    @foreach ($applications as $application)
                        <div class="application-item">
                            <div class="company-brand">
                                {{ strtoupper(substr($application->offre->titre, 0, 2)) }}
                            </div>
                            <div class="application-info">
                                <h4>{{ $application->offre->titre }}</h4>
                                <p>{{ $application->offre->titre }}</p>
                                <small>Applied at : {{ $application->applied_at }}</small>
                            </div>
                            <span class="status-badge {{ $application->statut }}">{{ $application->statut }}</span>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
