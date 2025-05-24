<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Tableau de bord Utilisateur')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column min-vh-100 bg-user-light">
    {{-- @php
    use App\Models\Notification;
    use Illuminate\Support\Facades\Auth;

    $unreadNotifications = 0;

    if (Auth::check()) {
        $unreadNotifications = Notification::where('utilisateur_id', Auth::user()->utilisateur_id)
                                ->where('lue', false)
                                ->count();
    }
@endphp --}}

    <!-- Navbar Utilisateur -->
    <nav class="navbar-user navbar navbar-expand-lg bg-user-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-semibold text-white" href="{{ route('dashboard.user') }}">
                <i class="bi bi-person-badge me-2"></i>App Intern
            </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarUser">
                <div class="dropdown">
                    <button class="btn btn-link nav-link dropdown-toggle d-flex align-items-center text-white gap-2"
                        type="button" data-bs-toggle="dropdown">
                        <div class="avatar-user d-flex justify-content-center align-items-center">
                            @php
                                $profile = Auth::user()->candidat_profile;
                            @endphp

                            @if ($profile && $profile->photo)
                                @php
                                    // Check if the photo is a URL (fake API) or a stored photo
                                    $isExternal = Str::startsWith($profile->photo, ['http://', 'https://']);
                                    $photoUrl = $isExternal ? $profile->photo : asset('storage/' . $profile->photo);
                                @endphp

                                <img src="{{ $photoUrl }}"
                                    class="rounded-circle border border-2 border-primary profile-avatar" width="38px"
                                    height="38px" style="object-fit: cover; object-position: center;">
                            @else
                                <div class="avatar-placeholder bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 38px; height: 38px;">
                                    {{ strtoupper(substr(Auth::user()->prenom, 0, 1)) }}{{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <span class="d-none d-lg-inline">
                            {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.user') }}">
                                <i class="bi bi-person-circle me-2"></i>My profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center px-3 py-2"
                                href="{{ route('dashboard.user') }}">
                                <i class="fas fa-home fa-fw me-2 text-primary"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger btn-logout-user">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="main-user-content flex-grow-1 py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer Utilisateur -->
    <footer class="footer-user text-center border-top py-3 mt-auto">
        <div class="container text-muted small">
            &copy; {{ now()->year }} StagiaireApp - Tous droits réservés.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
