@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Admin Dashboard</h1>
    {{-- <h2>Welcome, {{ Auth::user()->nom}} </h2> --}}

    <div class="export-buttons">
        <a href="#" class="btn btn-export btn-export-applications">
            <i class="bi bi-download"></i>
            Export Applications
        </a>
        <a href="#" class="btn btn-export btn-export-offers">
            <i class="bi bi-download"></i>
            Export Offers
        </a>
        <a href="#" class="btn btn-export btn-export-candidates">
            <i class="bi bi-download"></i>
            Export Candidates
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5>Total Offers</h5>
                    <h3>{{ $totalOffers }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>Total Applications</h5>
                    <h3>{{ $totalApplications }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5>Total Candidates</h5>
                    <h3>{{ $totalCandidates }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5>Pending Applications</h5>
                    <h3>{{ $pendingApplications }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Applications -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-headere">Recent Applications</div>
                <ul class="list-group list-group-flush">
                    @forelse ($recentApplications as $app)
                        <li class="list-group-item">
                            <strong>{{ $app->candidat->prenom_candidat }} {{ $app->candidat->nom_candidat }}</strong> 
                            applied to <strong>{{ $app->offre->titre }}</strong>
                            <br>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($app->applied_at)->format('M d, Y') }}</small>
                        </li>
                    @empty
                        <li class="list-group-item">No recent applications.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Recent Offers -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-headere">Recent Offers</div>
                <ul class="list-group list-group-flush">
                    @forelse ($recentOffers as $offer)
                        <li class="list-group-item">
                            <strong>{{ $offer->titre }}</strong>
                            <br>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($offer->creer_at)->format('M d, Y') }}
                            </small>
                        </li>
                    @empty
                        <li class="list-group-item">No recent offers.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    {{-- chart  --}}
    <div style="width: 600px" class='chart-container '>
        {!! $chart->container() !!}
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {!! $chart->script() !!}
</div>

@endsection
