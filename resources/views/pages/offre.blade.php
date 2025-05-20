@extends('layouts.app')
@section('content')
<section class="offres-list-section">
    <div class="container">
        <header class="section-header text-center mb-5">
            <h1 class="section-title-offre">Internship Opportunities</h1>
        
            {{-- * filter section --}}
            <form method="GET" action="{{ route('offre') }}" class="filter-form">
                <div class="filter-grid">
                    <input type="text" name="search" 
                           class="form-control search-input" 
                           placeholder="Search opportunities..."
                           value="{{ request('search') }}">
                    
                    <select name="localisation" class="form-select location-select">
                        <option value="">All Locations</option>
                        @foreach ($offres->unique('localisation') as $offre)  <!-- unique() : method to get unique localisation values pour eviter la repetition -->
                            <option value="{{ $offre->localisation }}" {{ request('localisation') == $offre->localisation ? 'selected' : '' }}>
                                {{ $offre->localisation }}
                            </option>
                        @endforeach
                    </select>
                    
                    <select name="duration" class="form-select duration-select">
                        <option value="">Any Duration</option>
                        @foreach ($offres->unique('duration') as $offre)
                            <option value="{{ $offre->duration }}" {{ request('duration') == $offre->duration ? 'selected' : '' }}>
                                {{ $offre->duration }} month
                            </option>
                        @endforeach
                    </select>
                    
                    <div class="button-group">
                        <button type="submit" class="btn filter-btn">
                            <i class="fas fa-filter me-2"></i>Apply
                        </button>
                        <a href="{{ route('offre') }}" class="btn clear-btn">
                            <i class="fas fa-undo me-2"></i>Clear
                        </a>
                    </div>
                </div>
            </form>
        </header>

        <div class="row g-4">
            @foreach ($offres as $offre)
            <div class="col-md-6 col-lg-4">
                <article class="offre-card hover-shade">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h2 class="offre-titre">{{ $offre->titre }}</h2>
                            <span class="offre-duree">{{ $offre->duration }} Month</span>
                        </div>
                        <div class="offre-localisation">
                            <i class="fas fa-map-marker-alt icon-accent"></i>
                            <span class="text-muted">{{ $offre->localisation }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="offre-description">
                            {{ Str::limit($offre->description, 120) }}
                        </p>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center date-container">
                            <div class="date-item">
                                <i class="fas fa-play-circle text-primary"></i>
                                <span class="date-label">Start Date</span>
                                <span class="date-value">{{ \Carbon\Carbon::parse($offre->date_debut)->format('d/m/Y') }}</span>
                            </div>
                            <div class="date-item">
                                <i class="fas fa-flag-checkered text-success"></i>
                                <span class="date-label">End Date</span>
                                <span class="date-value">{{ \Carbon\Carbon::parse($offre->date_fin)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3 action-buttons">
                            <a href="{{ route('offres.show', $offre->offre_id) }}" 
                               class="btn btn-details">
                               <i class="fas fa-search-plus"></i> Details
                            </a>
                              @auth
                                <a href="{{ route('offres.apply', $offre->offre_id) }}" class="btn btn-postuler">
                                    <i class="fas fa-paper-plane"></i> Apply now
                                </a>
                             @else
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <i class="fas fa-paper-plane"></i> Apply
                                </button>
                             @endauth
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
        {{-- * pagination section --}}
       <div class="d-flex justify-content-center mt-4">
                @if($offres->lastPage() > 1)   <!-- check if there more than one page of offre if not hide the paginate bar -->
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        {{-- Previous page link --}}
                        @if($offres->currentPage() > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $offres->url($offres->currentPage() - 1) }}"
                                data-page="{{ $offres->currentPage() - 1 }}">
                                <span aria-hidden="true">&laquo;</span>
                             </a>
                        </li>
                        @endif

                        {{-- Page numbers --}}
                        @for($i = 1; $i <= $offres->lastPage(); $i++)
                            <li class="page-item {{ $i === $offres->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $offres->url($i) }}" data-page="{{ $i }}">{{ $i }}</a>
                            </li>
                            @endfor

                            {{-- Next page link --}}
                            @if($offres->currentPage() < $offres->lastPage())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $offres->url($offres->currentPage() + 1) }}"
                                        data-page="{{ $offres->currentPage() + 1 }}">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                                @endif
                    </ul>
                </nav>
                @endif
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
    if (window.scrollY > 250) {
        backToTopBtn.style.display = 'block';
    } else {
        backToTopBtn.style.display = 'none';
    }
});

backToTopBtn.addEventListener('click', function (e) {
    e.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
            
            

// function handleApply(isAuthenticated) {
//     if (!isAuthenticated) {
//         const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
//         loginModal.show();
//     } else {
//         window.location.href = 'login'; // Or your route
//     }
// }
</script>
@endpush
@endsection