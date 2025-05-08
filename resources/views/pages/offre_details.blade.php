@extends('layouts.app')

@section('content')
<div class="offer-detail-section">
    <!-- Header -->
    <div class="container">
        <div class="offer-header">
            <a href="{{ route('offre') }}" class="btn-back mt-3">
                <i class="fas fa-chevron-left"></i> Back to Offers
            </a>
            <h1 class="offer-main-title">{{ $offre->titre }}</h1>
            <div class="offer-meta-header">
                <span class="meta-badge">
                    <i class="fas fa-map-marker-alt icon-accent"></i>
                    {{ $offre->localisation }}
                </span>
                <span class="meta-badge duration-badge">
                    <i class="fas fa-clock icon-accent"></i>
                    {{ $offre->duration }} Month
                </span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="offer-detail-card">
            <div class="date-cards-container">
                <div class="date-card gradient-border">
                    <div class="date-item">
                        <span class="date-label">Start Date</span>
                        <time class="date-value">{{ \Carbon\Carbon::parse($offre->date_debut)->format('M d, Y') }}</time>
                    </div>
                </div>
                <div class="date-card gradient-border">
                    <div class="date-item">
                        <span class="date-label">End Date</span>
                        <time class="date-value">{{ \Carbon\Carbon::parse($offre->date_fin)->format('M d, Y') }}</time>
                    </div>
                </div>
            </div>

            <article class="offer-description-card">
                <h2 class="description-title">Opportunity Details</h2>
                <p class="offre-description">{{ $offre->description}} 
                </p>
            </article>
            <article class="offer-description-card">
                <h2 class="description-title">Type</h2>
                <p class="offre-description">{{ $offre->type }}</p>
            </article>

            <div class="offer-action-footer">
                <div class="poster-info">
                    <span class="posted-by">
                        Posted by {{ $offre->utilisateur?->nom }} {{ $offre->utilisateur?->prenom }}
                    </span>
                    <time class="posted-at">
                       on {{ \Carbon\Carbon::parse($offre->creer_at)->format('M d Y H:i') }}
                    </time>
                </div>
                <button class="btn-postuler">
                    Apply Now
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
