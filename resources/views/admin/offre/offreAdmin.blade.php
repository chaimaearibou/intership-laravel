@extends('layouts.admin')
@section('content')
@section('page_title', 'Internship Offers Management')
<div class="container">
    {{-- Afficher la message de successe --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 70px">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- <h1>Internship Offers Management</h1> --}}
    <div class="btn-add-container">
        <a href="{{ route('offre.create') }}" class="btn-add"> <i class="fas fa-plus"></i> Add New Offer</a>
        {{-- * back to the dashbord btn --}}
        <a href=" {{ route('dasbordAdmin') }}" class='btn btn-secondary back_btn'><i
                class="bi bi-arrow-bar-left"></i></a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offres as $offre)
                <tr>
                    <td>{{ $offre->offre_id }}</td>
                    <td>{{ $offre->titre }}</td>
                    <td>{{ Str::limit($offre->description, 100) }}</td>
                    <td>
                        <div class="actions-container">
                            {{-- ! la btn pour modifier un offre --}}
                            <a href="{{ route('offre.edit', $offre) }}" class="btn-edit">
                                <i class="bi bi-pencil-square sm"></i>
                            </a>
                            <form action="{{ route('offre.destroy', $offre) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                {{-- ! la button pour supprimre un offre --}}
                                <button type="button" class="btn-delete btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal{{ $offre->offre_id}}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                            {{-- ? un verification pour supprimer  --}}
                            <div class="modal fade" id="confirmDeleteModal{{ $offre->offre_id}}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger fw-bold">Delete Offer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-0">Are you sure you want to delete this offer? This action
                                                cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('offre.destroy', $offre) }}" method="POST">
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
</div>
@endsection
