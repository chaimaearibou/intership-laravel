@extends('layouts.admin')
@section('content')
@section('page_title', 'Espace Candidat')

<div class="container">

    {{-- * Afficher la message de successe --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 70px">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="btn-back-container ">

        {{-- todo: les input pour la filter rehrche --}}
        <form method="GET" action="{{ route('candidats.index') }}" class="d-flex gap-3 mb-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email"
                class="form-control form-control-candidat" />
            <select name="statut" class="form-select form-select-candidat">
                <option value="">All Status</option>
                <option value="actif" {{ request('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ request('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
            </select>

            <button type="submit" class="btn btn-primary filter"><i class="bi bi-funnel"></i> Filter</button>
        </form>
        {{-- * back to the dashbord btn --}}
        <a href=" {{ route('dasbordAdmin') }}" class='btn btn-secondary backe_btn'><i class="bi bi-arrow-bar-left"></i>
            
        </a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID </th>
                <th>Full name </th>
                <th>Email</th>
                <th>Number</th>
                <th>Statut</th>
                <th>action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($candidats as $candidat)
                <tr>
                    <td>{{ $candidat->candidat_id }}</td>
                    <td>{{ $candidat->prenom_candidat }} {{ $candidat->nom_candidat }} </td>
                    <td>{{ $candidat->utilisateur->email }}</td>
                    <td>{{ $candidat->number }}</td>
                    <td>
                        <div class="status-indicator">
                            <div class="status-dot {{ $candidat->statut == 'actif' ? 'actif' : 'inactif' }}"></div>
                            <span class="status-text">{{ ucfirst($candidat->statut) }}</span>
                            <!--   ucfirst pour mettre la premiere lettre en majuscule -->
                        </div>
                    </td>

                    <td>
                        <div class="actions-container">
                            {{-- ! btn pour show un candiat --}}
                            <a href="{{ route('candidats.show', $candidat) }}" class="btn-edit btn-view">
                                <i class="bi bi-eye"></i>
                            </a>
                            {{-- ! la button pour supprimre un candiaat --}}
                            <form action="{{ route('candidats.destroy', $candidat) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal{{ $candidat->id }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                            {{-- ? un verification pour supprimer  --}}
                            <div class="modal fade" id="confirmDeleteModal{{ $candidat->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger fw-bold">Delete Offer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-0">Are you sure you want to delete this profile? This action
                                                cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('candidats.destroy', $candidat) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- ? end verification   --}}

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- *pagination section --}}
    <div class="d-flex justify-content-center mt-4 pagination">
        @if ($candidats->lastPage() > 1)
            <!-- check if there more than one page of offre if not hide the paginate bar -->
            <nav aria-label="Page navigation">
                <ul class="pagination mb-0">
                    {{-- Previous page link --}}
                    @if ($candidats->currentPage() > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $candidats->url($candidats->currentPage() - 1) }}"
                                data-page="{{ $candidats->currentPage() - 1 }}">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif

                    {{-- Page numbers --}}
                    @for ($i = 1; $i <= $candidats->lastPage(); $i++)
                        <li class="page-item {{ $i === $candidats->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $candidats->url($i) }}"
                                data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Next page link --}}
                    @if ($candidats->currentPage() < $candidats->lastPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ $candidats->url($candidats->currentPage() + 1) }}"
                                data-page="{{ $candidats->currentPage() + 1 }}">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif
    </div>
</div>



    



@endsection
