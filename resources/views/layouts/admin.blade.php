<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ config('app.name', 'Gestion de Stage') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="logo-admin">
                <h3>Control Panel</h3>
            </div>

            <nav class="nav-admin">
                <ul>
                    <li><a href="#"><i class="bi bi-house-door-fill"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fas fa-briefcase"></i> Internship Offers</a></li>
                    <li><a href="#"><i class="fas fa-file-alt"></i> Candidatures</a></li>
                    <li><a href="#"><i class="fas fa-users"></i> Applications</a></li>
                    <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Header -->
            <header class="admin-header">
                <div class="header-container">
                    <div class="header-left">
                        <h1 class="header-title"> Dashboard</h1>
                    </div>
                    
                    <div class="header-right">
                        <div class="admin-notifications">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </div>
                        <button class="btn-logout">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </div>
                </div>
            </header>

            <!-- Dynamic Content -->
            @yield('content')

            <!-- Footer -->
            <footer class="admin-footer">
                <p>&copy; {{ date('Y') }} Gestion de Stage - Tous droits réservés</p>
            </footer>
        </main>
    </div>

</body>
</html>