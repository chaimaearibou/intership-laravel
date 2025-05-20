@extends('layouts.user')

@section('title', 'Candidature')

@section('content')

<div class="application-container">
        <div class="mb-2">
        <a href="{{ route('offre') }}" class="back-button">
            <i class="fas fa-chevron-left"></i>
            <span class="d-none d-md-inline">Return to Offers</span>
        </a>
    </div>
    
    <h1 class="application-header">Postuler : {{ $offre->titre }}</h1>

    @if ($errors->any())
        <div class="alert-validation">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="offre_id" value="{{ $offre->offre_id }}">

        <div class="form-section">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">First name</label>
                    <input type="text" name="nom" 
                           class="form-control-custom"
                           value="{{ $user->nom }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Last name</label>
                    <input type="text" name="prenom" 
                           class="form-control-custom"
                           value="{{ $user->prenom }}"
                           required>
                </div>
            </div>
        </div>

        <div class="form-section">
            <label class="form-label"> Email</label>
            <input type="email" name="email" 
                   class="form-control-custom bg-gray-50"
                   value="{{ $user->email }}"
                   readonly>

            <label class="form-label mt-3">Phone</label>
            <input type="tel" name="number" 
                   class="form-control-custom"
                   value="{{ $user->candidat_profile->number ?? '' }}"
                   placeholder="+33 6 12 34 56 78"
                   required>
        </div>

        <div class="form-section">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="file-upload-box">
                        <label class="form-label">cover letter.</label>
                        <input type="file" name="lettre_motivation"
                               class="form-control-custom"
                               accept="application/pdf"
                               required>
                        <div class="mt-2 text-sm text-slate-500">PDF only (max 5MB)</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="file-upload-box">
                        <label class="form-label">Curriculum Vitae (CV)</label>
                        <input type="file" name="cv"
                               class="form-control-custom"
                               accept="application/pdf"
                               required>
                        <div class="mt-2 text-sm text-slate-500">PDF only (max 5MB)</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-section">
            <label class="form-label">
                LinkedIn profile
                <span class="optional-tag">(optional)</span>
            </label>
            <input type="url" name="linkedin" 
                   class="form-control-custom"
                   placeholder="https://www.linkedin.com/in/mon-profil">

            <label class="form-label mt-4">
               Additional information
                <span class="optional-tag">(optional)</span>
            </label>
            <textarea name="autres_infos" 
                      class="form-control-custom"
                      rows="4"
                      placeholder="Portfolio, certifications, ou autres informations pertinentes..."></textarea>
        </div>

        <div class="form-check mt-4 mb-4">
            <input type="checkbox" name="confirm" id="confirm" class="form-check-input" required>
            <label class="form-check-label" for="confirm">
                I accept the terms and conditions.
            </label>
        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-paper-plane"></i>
           Send my application
        </button>
    </form>
</div>
@endsection