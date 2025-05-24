@extends('layouts.user')

@section('title', 'User Profile')

@section('content')

    <div class="user-profile-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Floating Home Button -->
        <a href="{{ route('profile.user') }}" class="floating-home-btn d-flex">
            <i class="bi bi-arrow-return-right"></i>
        </a>

        <div class="user-profile-header">
            <div class="user-profile-avatar-wrapper">
                @php
                    $profile = Auth::user()->candidat_profile;
                @endphp

                @if ($profile && $profile->photo)
                    @php
                        $isExternal = Str::startsWith($profile->photo, ['http://', 'https://']);
                        $photoUrl = $isExternal ? $profile->photo : asset('storage/' . $profile->photo);
                    @endphp
                    <img src="{{ $photoUrl }}" class="user-profile-avatar">
                @else
                    <div class="user-profile-avatar-initials">
                        {{ strtoupper(substr(Auth::user()->prenom, 0, 1)) }}{{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
                    </div>
                @endif

                <!-- Hidden Form for Photo Update -->
                <form action="{{ route('profile.photo.update', ['candidat_profile' => $profile->candidat_id]) }}"
                    method="POST" enctype="multipart/form-data" id="photo-form" style="display:none;">
                    @csrf
                    @method('PUT')
                    <input type="file" name="photo" id="photo-input" accept="image/*"
                        onchange="document.getElementById('photo-form').submit();">
                </form>


                <!-- Pen icon triggers file input -->
                <button class="user-profile-avatar-edit" title="Edit photo"
                    onclick="document.getElementById('photo-input').click(); return false;">
                    <i class="fas fa-pen"></i>
                </button>
            </div>

            <h1 class="text-2xl font-semibold text-gray-900">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h1>
            <p class="text-gray-600 mt-1">{{ $profile->statut ?? 'Candidate' }}</p>
        </div>

        <div class="user-profile-content">
            <!-- Personal Information (Update Form) -->
            <section class="user-profile-section">
                <h2 class="user-profile-section-title">Personal Information</h2>

                <form action="{{ route('profile.update', ['candidat_profile' => $profile->candidat_id]) }}" method="POST"
                    enctype="multipart/form-data" class="user-profile-info-grid">
                    @csrf
                    @method('PUT')

                    <!-- Nom -->
                    <div class="user-profile-info-item">
                        <label for="nom_candidat" class="user-profile-info-label">First Name</label>
                        <input type="text" id="nom_candidat" name="nom_candidat" class="user-profile-info-value"
                            value="{{ old('nom_candidat', $profile->nom_candidat) }}" required maxlength="100">
                    </div>

                    <!-- Prénom -->
                    <div class="user-profile-info-item">
                        <label for="prenom_candidat" class="user-profile-info-label">last Name</label>
                        <input type="text" id="prenom_candidat" name="prenom_candidat" class="user-profile-info-value"
                            value="{{ old('prenom_candidat', $profile->prenom_candidat) }}" required maxlength="100">
                    </div>

                    <!-- Téléphone -->
                    <div class="user-profile-info-item">
                        <label for="number" class="user-profile-info-label">Phone</label>
                        <input type="text" id="number" name="number" class="user-profile-info-value"
                            placeholder="000 00 00 00 00" value="{{ old('number', $profile->number) }}" maxlength="20">
                    </div>

                    <!-- Email désactivé -->
                    <div class="user-profile-info-item">
                        <label for="email" class="user-profile-info-label">Email</label>
                        <input type="email" id="email" name="email" class="user-profile-info-value"
                            value="{{ Auth::user()->email }}" disabled>
                    </div>

                    <!-- Submit Button -->
                    <div class="user-profile-info-item" style="grid-column: span 2;">
                        <button type="submit" class="usere-profile-edit-btn" title="Update profile">
                            <i class="fa-solid fa-file-pen"></i> Update
                        </button>
                    </div>
                </form>
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
        </div>
    </div>

@endsection
