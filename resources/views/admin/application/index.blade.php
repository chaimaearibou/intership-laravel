@extends('layouts.admin')
@section('content')
@section('page_title', 'Applications Management')

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
    {{-- div de back btn et recherche et filtrage --}}
    <div class="btn-back-container ">

        {{-- todo: les input pour la filter rehrche --}}
        <form id="filter-form" class="d-flex gap-3 mb-4">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search by candidate or offer" class="form-control form-control-candidat" />
            <select name="statut" class="form-select form-select-candidat">
                <option value="">All Status</option>
                <option value="pending">pending</option>
                <option value="accept">accept</option>
                <option value="refuse">refuse</option>
            </select>

            <button type="submit" class="btn btn-primary filter"><i class="bi bi-funnel"></i> Filter</button>
        </form>
        {{-- * back to the dashbord btn --}}
        <a href=" {{ route('dasbordAdmin') }}" class='btn btn-secondary backe_btn'><i class="bi bi-arrow-bar-left"></i>

        </a>
    </div>

    <table class="admin-table" id="applications-table">
        <thead>
            <tr>
                <th>ID </th>
                <th>Candidate</th>
                <th>Offer</th>
                <th>Status</th>
                <th>Applied At</th>
                <th>Documents</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody id="applications-tbody">
            @foreach ($applications as $application)
                <tr>
                    <td>{{ $application->application_id }}</td>
                    <td>
                        {{ $application->candidat->prenom_candidat }}
                        {{ $application->candidat->nom_candidat }}
                    </td>
                    <td>{{ optional($application->offre)->titre ?? 'N/A' }}</td>
                    <td>
                        <form class="status-form" data-application-id="{{ $application->application_id }}">
                            @csrf
                            <select name="statut" class="form-select status-select"
                                style="width: 150px; padding: 0.25rem 0.5rem;"
                                data-current-status="{{ $application->statut }}">
                                <option value="pending" {{ $application->statut == 'pending' ? 'selected' : '' }}>
                                    pending</option>
                                <option value="accept" {{ $application->statut == 'accept' ? 'selected' : '' }}>accept
                                </option>
                                <option value="refuse" {{ $application->statut == 'refuse' ? 'selected' : '' }}>refuse
                                </option>
                            </select>
                            <span class="badge d-none status-badge"></span>
                        </form>
                    </td>
                    <td>{{ $application->applied_at }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ asset('storage/' . $application->cv) }}" class="btn btn-sm btn-outline-primary"
                                target="_blank">
                                <i class="bi bi-file-pdf"></i> CV
                            </a>
                            <a href="{{ asset('storage/' . $application->lettre_motivation) }}"
                                class="btn btn-sm btn-outline-secondary" target="_blank">
                                <i class="bi bi-file-text"></i> Letter
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('applications.show', $application) }}" class="btn-edit btn-view"
                                title="View details">
                                <i class="bi bi-eye"></i>
                            </a>
                            {{-- ! la btn pour supprimerune applicaion --}}
                            <form action="{{ route('applications.destroy', $application) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete btn-sm btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal{{ $application->application_id }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                {{-- ? un verification pour supprimer  --}}
                <div class="modal fade" id="confirmDeleteModal{{ $application->application_id }}" tabindex="-1"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger fw-bold">Delete Application</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-0">Are you sure you want to delete this application? This action
                                    cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('applications.destroy', $application) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ? end verification   --}}
            @endforeach
        </tbody>
    </table>
    {{-- *pagination section --}}
    <div class="d-flex justify-content-center mt-4 pagination">
        @if ($applications->lastPage() > 1)
            <!-- check if there more than one page of offre if not hide the paginate bar -->
            <nav aria-label="Page navigation">
                <ul class="pagination mb-0">
                    {{-- Previous page link --}}
                    @if ($applications->currentPage() > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $applications->url($applications->currentPage() - 1) }}"
                                data-page="{{ $applications->currentPage() - 1 }}">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif

                    {{-- Page numbers --}}
                    @for ($i = 1; $i <= $applications->lastPage(); $i++)
                        <li class="page-item {{ $i === $applications->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $applications->url($i) }}"
                                data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Next page link --}}
                    @if ($applications->currentPage() < $applications->lastPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ $applications->url($applications->currentPage() + 1) }}"
                                data-page="{{ $applications->currentPage() + 1 }}">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        // Extract status color initialization to a reusable function
function initializeStatusColors() {
    document.querySelectorAll('.status-select').forEach(select => {
        // Clear existing status classes
        select.classList.remove('pending', 'accept', 'refuse');
        // Add current status class
        select.classList.add(select.value);
    });
}

// Extract status change handler to a reusable function
function setupStatusHandlers() {
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function(e) {
            const form = this.closest('.status-form');
            const applicationId = form.dataset.applicationId;
            const originalStatus = this.dataset.currentStatus;
            const newStatus = this.value;

            // Visual feedback while updating
            this.disabled = true;
            const originalColor = this.style.backgroundColor;
            this.style.backgroundColor = '#f8f9fa';

            fetch(`/applications/${applicationId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ statut: newStatus })
            })
            .then(response => {
                if (!response.ok) throw new Error('Update failed');
                // Update UI only after successful response
                this.classList.remove(originalStatus);
                this.classList.add(newStatus);
                this.dataset.currentStatus = newStatus;
            })
            .catch(error => {
                console.error('Error:', error);
                // Revert to original status
                this.value = originalStatus;
                this.classList.remove(newStatus);
                this.classList.add(originalStatus);
            })
            .finally(() => {
                this.disabled = false;
                this.style.backgroundColor = originalColor;
            });
        });
    });
}

// Initial setup
document.addEventListener('DOMContentLoaded', function() {
    initializeStatusColors();
    setupStatusHandlers();
});

// Modified filter code
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('filter-form');
    const tbody = document.getElementById('applications-tbody');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const search = document.querySelector('input[name="search"]').value;
        const statut = document.querySelector('select[name="statut"]').value;

        fetch(`{{ route('application.index') }}?search=${search}&statut=${statut}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newTbody = doc.querySelector('#applications-tbody');
            tbody.innerHTML = newTbody.innerHTML;
            
            // Reinitialize after AJAX update
            initializeStatusColors();
            setupStatusHandlers();
        })
        .catch(error => {
            console.error('Error filtering:', error);
        });
    });
});
    </script>
@endpush
@endsection
