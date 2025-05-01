@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1>{{ $offre->titre }}</h1>
    <p class="text-muted">{{ $offre->localisation }} • Durée: {{ $offre->duration }} jours</p>
    <p>{{ $offre->description }}</p>
    <hr>
    <p><strong>Début:</strong> {{ $offre->date_debut }}</p>
    <p><strong>Fin:</strong> {{ $offre->date_fin }}</p>
</div>
@endsection
