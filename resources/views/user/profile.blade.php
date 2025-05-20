@extends('layouts.user')

@section('title', 'User Profile')

@section('content')

<div class="user-profile-container">
    {{-- alert pour affcher la message de sucees --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Floating Home Button -->
    <a href="{{ route('home') }}" class="floating-home-btn d-flex">
        <i class="bi bi-house-door justify-center align-content-center" ></i>
    </a>

    <div class="user-profile-header">
        <div class="user-profile-avatar-wrapper">
            @php
                $profile = Auth::user()->candidat_profile;
            @endphp

            @if($profile && $profile->photo)
                @php
                    $isExternal = Str::startsWith($profile->photo, ['http://', 'https://']);
                    $photoUrl = $isExternal ? $profile->photo : asset('storage/' . $profile->photo);
                @endphp

                <img src="{{ $photoUrl }}" 
                     class="user-profile-avatar" >
            @else
                <div class="user-profile-avatar-initials">
                    {{ strtoupper(substr(Auth::user()->prenom, 0, 1)) }}{{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
                </div>
            @endif

                {{-- <button class="user-profile-avatar-edit" title="Edit photo">
                    <i class="fas fa-pen"></i>
                </button> --}}
        </div>
        <h1 class="text-2xl font-semibold text-gray-900">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h1>
        <p class="text-gray-600 mt-1">{{ $profile->statut ?? 'Candidate' }}</p>
    </div>

    <div class="user-profile-content">
        <!-- Personal Information -->
        <section class="user-profile-section">
            <h2 class="user-profile-section-title">Personal Information</h2>
            <div class="user-profile-info-grid">
                <div class="user-profile-info-item">
                    <div class="user-profile-info-label">Full Name</div>
                    <div class="user-profile-info-value">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</div>
                </div>
                
                <div class="user-profile-info-item">
                    <div class="user-profile-info-label">Email</div>
                    <div class="user-profile-info-value">{{ Auth::user()->email }}</div>
                </div>
                
                <div class="user-profile-info-item">
                    <div class="user-profile-info-label">Phone Number</div>
                    <div class="user-profile-info-value">{{ $profile->number ?? 'Not provided' }}</div>
                </div>
            </div>
        </section>

        <!-- Account Details -->
        <section class="user-profile-section">
            <h2 class="user-profile-section-title">Account Details</h2>
            <div class="user-profile-info-grid">
                <div class="user-profile-info-item">
                    <div class="user-profile-info-label">Account Type</div>
                    <div class="user-profile-info-value">Candidate</div>
                </div>
                
                <div class="user-profile-info-item">
                    <div class="user-profile-info-label">Created On</div>
                    <div class="user-profile-info-value">
                        {{ Auth::user()->created_at->format('M d, Y \a\t H:i') }}
                    </div>
                </div>
            </div>
        </section>

        <!-- Action Buttons -->
        <div class="user-profile-actions">
            <a href="{{ route('profile.edite',  ['candidat_profile' => Auth::user()->candidat_profile->candidat_id]) }}" class="user-profile-edit-btn" title="Edit profile">
                <i class="fas fa-edit mr-2"></i>
                Edit Profile
            </a>
            <button class="user-profile-delete-btn user-profile-edit-btn" title="Delete account">
                <i class="fas fa-trash-alt mr-2"></i>
                Delete Account
            </button>
        </div>
    </div>
</div>

@endsection
