@extends('layouts.admin')
@section('content')
@section('page_title', 'Edit Internship Offer')

<div class="container">
    <!-- Header Section -->
    <div class="admin-form-header d-flex justify-content-between align-items-center ">
        <h2 class="page-title">Edite Offer</h2>
        <a href="{{ route('offreAdmin') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-short"></i> Back to List
        </a>
    </div>

    <!-- Form Container -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form class="row g-4" action="{{ route('offre.update', $offre) }}" method="POST" id="offreForm">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="col-md-6">
                    <label for="titre" class="form-label">Title</label>
                    <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre"
                        name="titre" value="{{ old('titre', $offre->titre) }}" required>
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Type -->
                <div class="col-6">
                    <label for="type" class="form-label col-6">Type</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type"
                        required>
                        <option value="hybride" {{ old('type', $offre->type) == 'hybride' ? 'selected' : '' }}>Hybrid
                        </option>
                        <option value="full remote" {{ old('type', $offre->type) == 'full remote' ? 'selected' : '' }}>
                            Full Remote</option>
                        <option value="on site" {{ old('type', $offre->type) == 'on site' ? 'selected' : '' }}>On Site
                        </option>

                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- !  input pout generer id de utilisateur i will remove her later when i do the authentificate --}}
                <input type="hidden" name="creer_par" value="1">

                <!-- Location -->
                <div class="col-md-6">
                    <label for="localisation" class="form-label">Location</label>
                    <select class="form-select @error('localisation') is-invalid @enderror" id="localisation"
                        name="localisation" required>
                        <option value="Tétouan"
                            {{ old('localisation', $offre->localisation) == 'Tétouan' ? 'selected' : '' }}>Tétouan
                        </option>
                        <option value="Tanger"
                            {{ old('localisation', $offre->localisation) == 'Tanger' ? 'selected' : '' }}>Tanger
                        </option>
                        <option value="M'diq"
                            {{ old('localisation', $offre->localisation) == "M'diq" ? 'selected' : '' }}>M'diq</option>
                        <option value="Al Hoceïma"
                            {{ old('localisation', $offre->localisation) == 'Al Hoceïma' ? 'selected' : '' }}>Al
                            Hoceïma</option>
                    </select>
                    @error('localisation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Duration -->
                <div class="col-md-6">
                    <label for="duration" class="form-label">Duration</label>
                    <select class="form-select @error('duration') is-invalid @enderror" id="duration" name="duration"
                        required>
                        <option value="">-- Choose duration --</option>
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}" @selected(old('duration', $offre->duration) == $i)>
                                {{ $i }} Month{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor
                    </select>
                    @error('duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Dates -->
                <div class="col-md-6">
                    <label for="date_debut" class="form-label">Start Date</label>
                    <input type="date" class="form-control @error('date_debut') is-invalid @enderror" id="date_debut"
                        name="date_debut" value="{{ old('date_debut', $offre->date_debut) }}" required>
                    @error('date_debut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="date_fin" class="form-label">End Date</label>
                    <input type="date" class="form-control @error('date_fin') is-invalid @enderror" id="date_fin"
                        name="date_fin" value="{{ old('date_fin', $offre->date_fin) }}" required>
                    @error('date_fin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="4" required>
                              {{ old('description', $offre->description) }}
                    </textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>





@endsection
