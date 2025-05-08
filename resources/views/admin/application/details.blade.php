@extends('layouts.admin')
@section('page_title', 'Application Details')


@section('content')
<div class="application-details-container">
    <div class="detail-card">
        <!-- Candidate Section -->
        <div class="detail-section">
            <h5>Candidate Information</h5>
            <div class="candidate-info">
                <img src="{{ $application->candidat->photo ? asset('storage/' . $application->candidat->photo) : asset('images/default-photo.jpg') }}" 
                     class="candidate-image" 
                     alt="Candidate photo">
                <div>
                    <h4>{{ $application->candidat->prenom_candidat }} {{ $application->candidat->nom_candidat }}</h4>
                    <a href="{{ route('candidats.show', $application->candidat->candidat_id) }}" 
                       class="btn btn-outline-primary">
                        <i class="bi bi-person-vcard"></i> View Full Profile
                    </a>
                </div>
            </div>
        </div>

        <!-- Offer Section -->
        <div class="detail-section">
            <h5>Offer Details</h5>
            <div class="offer-meta">
                <p><strong>Title:</strong> {{ $application->offre->titre ?? 'N/A' }}</p>
                <p><strong>Location:</strong> {{ $application->offre->localisation ?? 'N/A' }}</p>
                <p><strong>Type:</strong> {{ $application->offre->type ?? 'N/A' }}</p>
                <p><strong>Duration:</strong> {{ $application->offre->duration ?? 'N/A' }} months</p>
                <p><strong>Start Date:</strong> 
                    {{ $application->offre->date_debut ? \Carbon\Carbon::parse($application->offre->date_debut)->format('M d, Y') : 'N/A' }}
                </p>
                <p><strong>End Date:</strong> 
                    {{ $application->offre->date_fin ? \Carbon\Carbon::parse($application->offre->date_fin)->format('M d, Y') : 'N/A' }}
                </p>
                            </div>
            <div class="mt-3">
                <h6>Description:</h6>
                <p class="text-muted">{{ $application->offre->description ?? 'No description available.' }}</p>
            </div>
        </div>

        <!-- Application Section -->
        <div class="detail-section">
            <h5>Application Status</h5>
            <div class="d-flex align-items-center gap-3">
                <span class="badge badge-{{ $application->statut }}">{{ $application->statut }}</span>
                <div>
                    <p class="mb-0"><strong>Applied At:</strong> 
                        {{ $application->applied_at ? \Carbon\Carbon::parse($application->applied_at)->format('M d, Y H:i') : 'N/A' }}
                    </p>
                    
                </div>
            </div>
        </div>

        <!-- Documents Section -->
        <div class="detail-section">
            <h5>Application Documents</h5>
            <div class="document-buttons">
                <a href="{{ asset('storage/' . $application->cv) }}" 
                   class="btn btn-primary"
                   target="_blank">
                    <i class="bi bi-file-pdf"></i> View CV
                </a>
                <a href="{{ asset('storage/' . $application->lettre_motivation) }}" 
                   class="btn btn-secondary"
                   target="_blank">
                    <i class="bi bi-file-text"></i> Motivation Letter
                </a>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('application.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Applications
            </a>
        </div>
    </div>
</div>
@endsection