@extends('layouts.app')

@section('content')
<section class="offres-list-section">
    <div class="container ">
        <header class="section-header text-center mb-5">
            <h1 class="section-titl">Opportunités de Stage</h1>
            <div class="header-divider"></div>
        </header>

        <div class="row g-4">
            @foreach ($offres as $offre)
            <div class="col-md-6 col-lg-4">
                <article class="offre-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-start">
                            <h2 class="offre-titre">{{ $offre->titre }}</h2>
                            <span class="offre-duree">{{ $offre->duration }} jours</span>
                        </div>
                        <div class="offre-localisation">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $offre->localisation }}
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="offre-description">
                            {{ Str::limit($offre->description, 120) }}
                        </p>
                    </div>

                    <div class="card-footer">
                        <div class="footer-dates">
                            <span class="date-debut">
                                <i class="fas fa-calendar-day"></i>
                                {{ \Carbon\Carbon::parse($offre->date_debut)->format('d/m/Y') }}
                            </span>
                            <span class="date-separator">-</span>
                            <span class="date-fin">
                                <i class="fas fa-calendar-day"></i>
                                {{ \Carbon\Carbon::parse($offre->date_fin)->format('d/m/Y') }}
                            </span>
                        </div>
                        
                        <div class="card-actions">
                            <a href="{{ route('offres.show', $offre->offre_id) }}" 
                               class="btn-details">
                               <i class="fas fa-chevron-circle-right"></i> Détails
                            </a>
                            <button class="btn-postuler">
                                <i class="fas fa-paper-plane"></i> Postuler
                            </button>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection