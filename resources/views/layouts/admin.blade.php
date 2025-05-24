<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ config('app.name', 'Gestion de Stage') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- ! test for loading icon --}}
    <div id="loader-overlay"
        class="position-fixed top-0 start-0 w-100 h-100 bg-white d-flex justify-content-center align-items-center">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    {{-- ! end test for loading icon --}}

    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <div class="logo-admin">
                    <h3>Control Panel</h3>
                </div>
            </div>

            <nav class="nav-admin">
                <ul>
                    <li><a href="{{ route('dasbordAdmin') }}"><i class="bi bi-house-door-fill"></i> Dashboard</a></li>
                    <li><a href="{{ route('offreAdmin') }}"><i class="fas fa-briefcase"></i> Internship Offers</a></li>
                    <li><a href="{{ route('candidats.index') }}"><i class="fas fa-file-alt"></i> Candidatures</a></li>
                    <li><a href="{{ route('application.index') }}"><i class="fas fa-users"></i> Applications</a></li>
                    {{-- <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li> --}}
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Header -->
            <header class="admin-header">
                <div class="header-container">
                    <div class="header-left">
                        <h1 class="header-title">@yield('page_title', 'Dashboard')</h1>
                    </div>

                    <div class="header-right">

                        <div class="admin-notifications" id="notification-bell"
                            style="position: relative; cursor: pointer;">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge" id="notif-count">0</span>

                            <div class="dropdown" id="notif-dropdown"
                                style="display: none; position: absolute; right: 0; top: 30px; background: #fff; border: 1px solid #ccc; border-radius: 5px; width: 250px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); z-index: 100;">
                                <ul id="notif-list" style="list-style: none; margin: 0; padding: 10px;"></ul>
                            </div>
                        </div>



                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn-logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Dynamic Content -->
            <div class="admin-content">
                @yield('content')
            </div>


            <!-- Footer -->
            <footer class="admin-footer">
                <p>&copy; {{ date('Y') }} Gestion de Stage - Tous droits réservés</p>
            </footer>
        </main>
    </div>

    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('loader-overlay');
            if (loader) {
                loader.classList.add('d-none');
                console.log('Loader hidden');
            }
        });


        //  notof script 
        document.getElementById('notification-bell').addEventListener('click', function() {
            const dropdown = document.getElementById('notif-dropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';

            // Fetch notifications if needed
            fetch('/admin/notifications') // adjust this route to match your controller
                .then(response => response.json())
                .then(data => {
                    document.getElementById('notif-count').textContent = data.unreadCount;
                    const list = document.getElementById('notif-list');
                    list.innerHTML = '';

                    if (data.notifications.length === 0) {
                        list.innerHTML = '<li>No notifications</li>';
                    } else {
                        data.notifications.forEach(notif => {
                            const li = document.createElement('li');
                            li.textContent = notif.message;
                            list.appendChild(li);
                        });
                    }
                });
        });
    </script>
    @stack('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>

</body>

</html>
