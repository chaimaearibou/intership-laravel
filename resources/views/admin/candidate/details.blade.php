@extends('layouts.admin')
@section('content')
@section('page_title', 'details Candidat')

<div class="container candidate-profile">
    <div class="card profile-card">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-image">
                {{-- <img src="{{ $candidat->photo ?? asset('images/default-photo.jpg') }}" alt="Candidate Photo" class="profile-img"> --}}
                @php
                    use Illuminate\Support\Str;
                    $photo = $candidat->photo;
                    // Check if it's an external URL or local path
$photoUrl = Str::startsWith($photo, ['http://', 'https://'])
    ? $photo
    : ($photo
        ? asset('storage/' . $photo)
        : asset('images/default-photo.jpg'));
                @endphp
                <img src="{{ $photoUrl }}" alt="Candidate Photo" class="profile-img">
            </div>
            <div class="profile-info">
                <h2 class="profile-name">
                    {{ $candidat->prenom_candidat }} {{ $candidat->nom_candidat }}
                </h2>
                <div class="status-indicator">
                    <div class="status-dot {{ $candidat->statut == 'actif' ? 'actif' : 'inactif' }}"></div>
                    <span class="status-text">{{ ucfirst($candidat->statut) }}</span>
                </div>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="profile-details">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Phone Number:</span>
                        <span class="detail-value">{{ $candidat->number }}</span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">User Account:</span>
                        <span class="detail-value">{{ $candidat->utilisateur->email }}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Candidate ID:</span>
                        <span class="detail-value">#{{ $candidat->candidat_id }}</span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Registration Date:</span>
                        <span class="detail-value">{{ $candidat->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="profile-footer">
            <a href="{{ route('candidats.index') }}" class="btn btn-secondary back-btn">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>


@endsection
